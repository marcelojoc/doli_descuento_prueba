/*DELETE FROM llx_const WHERE name='MYMODULE_IT_WORKS' AND
entity='__ENTITY__';
INSERT INTO llx_const (name, value, type, note, visible, entity) VALUES
('MYMODULE_IT_WORKS','1','chaine','hola pruebas',1,'__ENTITY__');*/

CREATE TABLE `dolibar`.`llx_prueba`( `rowid` INT(10) NOT NULL AUTO_INCREMENT, `nombre` VARCHAR(200), PRIMARY KEY (`rowid`) ) ENGINE=INNODB; 
