-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tempo de Geração: Nov 30, 2011 as 07:42 PM
-- Versão do Servidor: 5.1.54
-- Versão do PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Banco de Dados: `pfsquid`
--
CREATE DATABASE `pfsquid` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pfsquid`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth`
--

DROP TABLE IF EXISTS `auth`;
CREATE TABLE IF NOT EXISTS `auth` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `auth`
--

INSERT INTO `auth` (`username`, `password`, `Name`) VALUES
('admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `Name` varchar(50) NOT NULL,
  `Descricao` varchar(50) NOT NULL,
  PRIMARY KEY (`Name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Estrutura da tabela `dominios`
--

DROP TABLE IF EXISTS `dominios`;
CREATE TABLE IF NOT EXISTS `dominios` (
  `idDominio` int(11) NOT NULL AUTO_INCREMENT,
  `Dominio` varchar(50) NOT NULL,
  `NameCategoria` varchar(50) NOT NULL,
  PRIMARY KEY (`idDominio`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Estrutura da tabela `servidores`
--

DROP TABLE IF EXISTS `servidores`;
CREATE TABLE IF NOT EXISTS `servidores` (
  `idServidor` int(11) NOT NULL AUTO_INCREMENT,
  `hostname` varchar(20) NOT NULL,
  `Port` int(11) NOT NULL,
  `Status` bit(1) NOT NULL,
  `IP` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `Local` varchar(50) NOT NULL,
  `Observacao` varchar(50) NOT NULL,
  PRIMARY KEY (`idServidor`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
