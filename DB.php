<?php
/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 27.12.2017
 * Time: 17:14
 */
require_once('config.php');

class DB
{
    public $link;
    function __construct(){
        $this->link = mysqli_connect(SERVER, USERNAME, PASSWORD);
        $this->link = mysqli_query($this->link, "CREATE DATABASE IF NOT EXISTS ".DB_NAME);
        $this->link = mysqli_connect(SERVER, USERNAME, PASSWORD, DB_NAME);

        $obj_customers = mysqli_query($this->link, "CREATE TABLE IF NOT EXISTS `obj_customers` (
          `id_customer` INT (11) AUTO_INCREMENT,
          `name_customer` VARCHAR (250),
          `company` ENUM('company_1','company_2','company_3') ,
          PRIMARY KEY (`id_customer`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8");

        $obj_contracts = mysqli_query($this->link, "CREATE TABLE IF NOT EXISTS `obj_contracts` (
          `id_contract` INT (11) AUTO_INCREMENT ,
          `id_customer` INT(11),
          `number` VARCHAR (100),
          `date_sign` DATE ,
          `staff_number` VARCHAR (100),
          PRIMARY KEY (`id_contract`),
          FOREIGN KEY (`id_customer`) REFERENCES `obj_customers`(`id_customer`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8");

        $obj_services = mysqli_query($this->link, "CREATE TABLE IF NOT EXISTS `obj_services` (
          `id_service` INT (11) AUTO_INCREMENT,
          `id_contract` INT(11),
          `title_service` VARCHAR (250),
          `status` ENUM('work','connecting','disconnected') ,
          PRIMARY KEY (`id_service`),
          FOREIGN KEY (`id_contract`) REFERENCES `obj_contracts`(`id_contract`)
        ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8");
    }
}