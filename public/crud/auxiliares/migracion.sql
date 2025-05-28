USE nombreDeLaBD;

DROP TABLE IF EXISTS `coches`;

CREATE TABLE IF NOT EXISTS`coches` (
  `id` SERIAL,
  `matricula` varchar(7) NOT NULL,
  `revisado` boolean NOT NULL,
  `kilometros` int NOT NULL,
  `precio` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

INSERT INTO `coches` (`matricula`, `revisado`, `kilometros`, `precio`) VALUES
  ('ABC1234', true, 100, 1000),
  ('AAA1111', false, 9999, 2000),
  ('ZZZ2222', true, 300000, 4000);

SELECT * FROM `coches`;

#-- Uso: mediante el script instalar.php o ejecutando en bash el comando:
#-- docker exec -i ajax-php-db-skills-1 mariadb -uroot -ppassDeRoot < public/migracion.sql
