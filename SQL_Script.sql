-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 18-05-2018 a las 20:55:07
-- Versión del servidor: 5.6.38
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- -----------------------------------------------------
-- Database `practica_mvc`
-- -----------------------------------------------------

CREATE DATABASE practica_mvc;

USE practica_mvc;

-- -----------------------------------------------------
-- Table `practica_mvc`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE usuarios(
  id INT PRIMARY KEY AUTO_INCREMENT,
  usuario  VARCHAR(45) NOT NULL,
  password VARCHAR(45) NOT NULL,
  correo VARCHAR(45) NOT NULL
);


-- -----------------------------------------------------
-- Volcado de datos para la tabla `usuarios`
-- -----------------------------------------------------
INSERT INTO  usuarios (usuario, password, correo)
VALUES ('admin','admin','admin@admin.com');



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


