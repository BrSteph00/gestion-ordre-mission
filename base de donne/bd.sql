CREATE TABLE `n_mission`(
    `id` int AUTO_INCREMENT,
    `nom` varchar(30) NOT NULL,
    `prenom` varchar(30) NOT NULL,
    `destination` varchar(250) NOT NULL,
    `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
