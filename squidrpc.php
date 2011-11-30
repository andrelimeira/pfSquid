<?php

##|+PRIV
##|*IDENT=page-squidrpclibrary
##|*NAME=SQUIDRPC Library page
##|*DESCR=Allow access to the 'XMLRPC Library' page.
##|*MATCH=squidrpc.php*
##|-PRIV

require("config.inc");
require("functions.inc");
require("filter.inc");
require("shaper.inc");
require("xmlrpc_server.inc");
require("xmlrpc.inc");
require("array_intersect_key.inc");
#Require for reload squidguard
require_once('globals.inc');
require_once('config.inc');
require_once('util.inc');
require_once('pfsense-utils.inc');
require_once('pkg-utils.inc');
require_once('filter.inc');
require_once('service-utils.inc');
require_once('squidguard.inc');

$xmlrpc_g = array(
    "return" => array(
        "true" => new XML_RPC_Response(new XML_RPC_Value(true, $XML_RPC_Boolean)),
        "false" => new XML_RPC_Response(new XML_RPC_Value(false, $XML_RPC_Boolean)),
        "authfail" => new XML_RPC_Response(new XML_RPC_Value(gettext("Authentication failed"), $XML_RPC_String))
    )
);

/*
 *   pfSense XMLRPC errors
 *   $XML_RPC_erruser + 1 = Auth failure
 */
$XML_RPC_erruser = 200;

/* EXPOSED FUNCTIONS */

$allow_site_doc = gettext("XMLRPC wrapper for eval(). This method must be called with two parameters: a string containing the local system\'s password followed by the PHP code to evaluate.");
$allow_site_sig = array(
    array(
        $XML_RPC_Boolean, // First signature element is return value.
        $XML_RPC_String, // password
        $XML_RPC_String, // Domain
        $XML_RPC_String, // Categories
    )
);

function allow_site_xmlrpc($raw_params) {
    global $config, $xmlrpc_g;
    $params = xmlrpc_params_to_php($raw_params);
    if (!xmlrpc_auth($params)) {
        return $xmlrpc_g['return']['authfail'];
    }
// aqui acontece a magica
    $config = parse_config(true);
    $categories_size = sizeof($config['installedpackages']['squidguarddest']['config']);
    for ($i = 0; $i < $categories_size; $i++) {
        if ($config['installedpackages']['squidguarddest']['config'][$i]['name'] == $params[1]) {
            $sites = $config['installedpackages']['squidguarddest']['config'][$i]['domains'];
            $xploed = explode(" ", $sites);
            $enco = false; //Domain Found y/n ?
            foreach ($xploed as $site) {
                if ($site == $params[0]) {
                    $enco = true;
                }
            }
            if (!$enco) {
                if (empty($config['installedpackages']['squidguarddest']['config'][$i]['domains'])) {
                    $sites .= $params[0];
                } else {
                    $sites .= " " . $params[0];
                }
                $config['installedpackages']['squidguarddest']['config'][$i]['domains'] = $sites;
                write_config();
                sg_reconfigure();
            }
        }
    }
// aqui termina a magica
    if ($toreturn) {
        $response = XML_RPC_encode($toreturn);
        return new XML_RPC_Response($response);
    } else
        return $xmlrpc_g['return']['true'];
}

$sendCategoriaDomain_doc = gettext("XMLRPC wrapper for eval(). This method must be called with two parameters: a string containing the local system\'s password followed by the PHP code to evaluate.");
$sendCategoriaDomain_sig = array(
    array(
        $XML_RPC_Boolean, // First signature element is return value.
        $XML_RPC_String, // password
        $XML_RPC_String, // Domains
        $XML_RPC_String, // Categories
    )
);

function sendCategoriaDomain_xmlrpc($raw_params) {
    global $config, $xmlrpc_g;
    $params = xmlrpc_params_to_php($raw_params);
    if (!xmlrpc_auth($params)) {
        return $xmlrpc_g['return']['authfail'];
    }
// aqui acontece a magica
    $config = parse_config(true);
    $categories_size = sizeof($config['installedpackages']['squidguarddest']['config']);
    for ($i = 0; $i < $categories_size; $i++) {
        if ($config['installedpackages']['squidguarddest']['config'][$i]['name'] == $params[1]) {
            $config['installedpackages']['squidguarddest']['config'][$i]['domains'] = $params[0];
            write_config();
            sg_reconfigure();
        }
    }
// aqui termina a magica
    if ($toreturn) {
        $response = XML_RPC_encode($toreturn);
        return new XML_RPC_Response($response);
    } else
        return $xmlrpc_g['return']['true'];
}

/* * ************************** */
$server = new XML_RPC_Server(
                array(
                    'pfsense.allow_site' => array('function' => 'allow_site_xmlrpc',
                        'signature' => $allow_site_sig,
                        'docstring' => $allow_site_doc),
                    'pfsense.sendCategoriaDomain' => array('function' => 'sendCategoriaDomain_xmlrpc',
                        'signature' => $sendCategoriaDomain_sig,
                        'docstring' => $sendCategoriaDomain_doc)
                )
);
?>