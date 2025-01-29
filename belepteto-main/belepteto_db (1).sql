-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2025. Jan 29. 10:25
-- Kiszolgáló verziója: 10.4.27-MariaDB
-- PHP verzió: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `belepteto_db`
--

DELIMITER $$
--
-- Eljárások
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateLog` (IN `p_user_id` INT, IN `p_in_out` VARCHAR(10))   BEGIN
    INSERT INTO log (user_id, in_out, log_time, deleted)
    VALUES (p_user_id, p_in_out, NOW(), 0);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateMunkavallalo` (IN `p_adojel` VARCHAR(20), IN `p_szul_datum` DATE, IN `p_nev` VARCHAR(100), IN `p_nem` ENUM('férfi','nő','egyéb'), IN `p_role` VARCHAR(50))   BEGIN
    INSERT INTO munkavallalo (adojel, szul_datum, nev, nem, role, created_at)
    VALUES (p_adojel, p_szul_datum, p_nev, p_nem, p_role, NOW());
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateUser` (IN `munkavallalo_idIn` INT(50), IN `passwordIN` VARCHAR(255))   INSERT INTO users (munkavallalo_id,passwordIn)
    VALUES (munkavallalo_idIn,password)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteMunkavalallo` (IN `p_id` INT(50))   DELETE FROM munkavallalo WHERE id = p_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteUser` (IN `p_id` INT(50))   DELETE FROM users WHERE user_id = p_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllLogs` ()   BEGIN
    SELECT * FROM log;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllMunkavallalo` ()   SELECT * FROM munkavallalo$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllUsers` ()   SELECT * FROM users$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetLogById` (IN `LogIdin` INT(50))   SELECT * FROM log WHERE id = LogIdIn$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetMunkavallaloById` (IN `workerIdIN` INT(11))   BEGIN
	SELECT * FROM munkavallalo WHERE munkavallalo.id = workerIdIN;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetUserById` (IN `user_idIN` INT)   SELECT * FROM users
WHERE user_id = user_idIN$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `HardDeleteLog` (IN `p_id` INT)   BEGIN
    DELETE FROM log WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SoftDeleteLog` (IN `p_id` INT)   BEGIN
    UPDATE log 
    SET deleted = 1 
    WHERE id = p_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateLog` (IN `p_id` INT, IN `p_user_id` INT, IN `p_in_out` VARCHAR(10))   BEGIN
    UPDATE log 
    SET user_id = p_user_id, in_out = p_in_out, log_time = NOW()
    WHERE id = p_id AND deleted = 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateMunkavallalo` (IN `munkavallaloIdIN` INT(11), IN `adojelIN` VARCHAR(20), IN `nevIN` VARCHAR(50), IN `nemIN` INT, IN `roleIN` INT)   BEGIN
	UPDATE munkavallalo SET `adojel` = adojelIN,`nev` = nevIN,`nem` = nemIN,`role` = roleIN 
    WHERE `id` = munkavallaloIdIN;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateUsers` (IN `user_idIN` INT, IN `passwordIN` VARCHAR(50))   UPDATE users SET `password` = passwordIN WHERE `user_id` = user_idIN$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `in_out` tinyint(1) NOT NULL,
  `log_time` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `log`
--

INSERT INTO `log` (`id`, `user_id`, `in_out`, `log_time`, `deleted`) VALUES
(1, 1, 1, '2025-01-15 09:38:45', NULL),
(2, 5, 0, '2025-01-29 09:24:33', 0);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `munkavallalo`
--

CREATE TABLE `munkavallalo` (
  `id` int(11) NOT NULL,
  `adojel` varchar(20) DEFAULT NULL,
  `szul_datum` date NOT NULL,
  `nev` varchar(50) NOT NULL,
  `nem` int(11) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- A tábla adatainak kiíratása `munkavallalo`
--

INSERT INTO `munkavallalo` (`id`, `adojel`, `szul_datum`, `nev`, `nem`, `role`, `created_at`) VALUES
(5, '1324', '2000-01-01', 'asd asd', 1, 1, '2025-01-15 10:16:46');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `munkavallalo_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`user_id`, `munkavallalo_id`, `password`) VALUES
(0, 5, 'qweqwe');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `munkavallalo`
--
ALTER TABLE `munkavallalo`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `munkavallalo`
--
ALTER TABLE `munkavallalo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
