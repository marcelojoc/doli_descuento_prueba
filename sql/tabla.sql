/*
SQLyog Ultimate v9.63 
MySQL - 5.5.24-log 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `llx_desc_reglas` (
	`rowid` int (20),
	`fk_desc` int (20),
	`nombre_regla` varchar (300),
	`estado` tinyint (1),
	`eliminado` tinyint (1)
); 
insert into `llx_desc_reglas` (`rowid`, `fk_desc`, `nombre_regla`, `estado`, `eliminado`) values('1','1','latas de Speed','1','1');
