CREATE DATABASE IF NOT EXISTS persons;
USE persons;

CREATE TABLE person (
    id      INT             NOT NULL,
    birth_date  DATE            NOT NULL,
    first_name  VARCHAR(80)     NOT NULL,
    last_name   VARCHAR(80)     NOT NULL,
    gender      ENUM ('M','F')  NOT NULL,    
    PRIMARY KEY (id)
);


INSERT INTO `person` (`id`, `birth_date`, `first_name`, `last_name`, `gender`) 
VALUES 
('1', '2008-02-04', 'valter', 'lobo', 'M'), 
('2', '2008-02-04', 'Maria', 'Lobo', 'F'), 
('3', '2008-02-04', 'ola', 'teste', 'M'), 
('4', '2004-02-04', 'teste', 'teste', 'M');