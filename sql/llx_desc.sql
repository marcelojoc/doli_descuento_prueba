/*
SQLyog Ultimate v9.63 
MySQL - 5.5.24-log 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `llx_desc` (
	`rowid` int (25),
	`fk_product` int (25),
	`linf` int (30),
	`lsup` int (30),
	`descuento` float ,
	`fk_regla` int (25),
	`tms` timestamp ,
	`fk_desc_log` int (15)
); 
insert into `llx_desc` (`rowid`, `fk_product`, `linf`, `lsup`, `descuento`, `fk_regla`, `tms`, `fk_desc_log`) values('1','2','1','11','0.3','1','2016-09-22 09:40:21',NULL);
insert into `llx_desc` (`rowid`, `fk_product`, `linf`, `lsup`, `descuento`, `fk_regla`, `tms`, `fk_desc_log`) values('2','2','12','23','0.12','1','2016-09-22 09:40:27',NULL);
insert into `llx_desc` (`rowid`, `fk_product`, `linf`, `lsup`, `descuento`, `fk_regla`, `tms`, `fk_desc_log`) values('3','2','24','71','0.13','1','2016-09-22 09:40:33',NULL);
insert into `llx_desc` (`rowid`, `fk_product`, `linf`, `lsup`, `descuento`, `fk_regla`, `tms`, `fk_desc_log`) values('4','2','72','0','0.16','1','2016-09-22 09:40:37',NULL);
