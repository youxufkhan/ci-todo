-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table todo_app.task
CREATE TABLE IF NOT EXISTS `task` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL,
  `task` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `task_status` tinyint(1) NOT NULL DEFAULT '0',
  `deadline` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `start_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  CONSTRAINT `task_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

-- Dumping data for table todo_app.task: ~7 rows (approximately)
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` (`id`, `userid`, `task`, `created_at`, `task_status`, `deadline`, `start_time`) VALUES
	(9, 3, 'task 1 for farhan', '2017-12-14 14:19:59', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(10, 3, 'task 2 for farhan', '2017-12-14 14:20:03', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(35, 5, 'test 3', '2017-12-14 17:13:01', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(36, 5, 'abcd', '2017-12-14 17:13:06', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
	(81, 1, 'task', '2017-12-30 13:00:55', 0, '2017-12-29 19:00:00', '2017-11-30 19:00:00'),
	(82, 1, 'task 2', '2017-12-30 13:01:17', 0, '2017-12-28 19:00:00', '2017-11-30 19:00:00'),
	(83, 1, 'new task', '2017-12-30 13:09:55', 0, '2017-12-30 19:00:00', '2017-12-01 19:00:00');
/*!40000 ALTER TABLE `task` ENABLE KEYS */;

-- Dumping structure for table todo_app.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table todo_app.user: ~8 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `password`) VALUES
	(1, 'yousuf', '$2y$10$xNGbtuLpQ8pOnOAC3jflguifSZeBnuWb/5qjztdZCTW.twMaWjSni'),
	(2, 'arbaz', '$2y$10$xNGbtuLpQ8pOnOAC3jflguifSZeBnuWb/5qjztdZCTW.twMaWjSni'),
	(3, 'farhan', '$2y$10$xNGbtuLpQ8pOnOAC3jflguifSZeBnuWb/5qjztdZCTW.twMaWjSni'),
	(4, 'dream', '$2y$10$xNGbtuLpQ8pOnOAC3jflguifSZeBnuWb/5qjztdZCTW.twMaWjSni'),
	(5, 'lucy', '$2y$10$xNGbtuLpQ8pOnOAC3jflguifSZeBnuWb/5qjztdZCTW.twMaWjSni'),
	(6, 'hassan', '$2y$10$xNGbtuLpQ8pOnOAC3jflguifSZeBnuWb/5qjztdZCTW.twMaWjSni'),
	(7, 'rambo', '$2y$10$xNGbtuLpQ8pOnOAC3jflguifSZeBnuWb/5qjztdZCTW.twMaWjSni'),
	(9, 'anum', '$2y$10$xNGbtuLpQ8pOnOAC3jflguifSZeBnuWb/5qjztdZCTW.twMaWjSni');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
