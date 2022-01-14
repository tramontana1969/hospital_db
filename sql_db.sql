-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: db:3306
-- Время создания: Янв 14 2022 г., 16:42
-- Версия сервера: 5.7.36
-- Версия PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sql_db`
--

DELIMITER $$
--
-- Процедуры
--
CREATE DEFINER=`admin`@`%` PROCEDURE `addMed` (IN `medName` CHAR(48), IN `medDiscr` TEXT, IN `medSideEff` TEXT)  BEGIN
INSERT INTO Medicine (name, description, side_effect)
VALUES (medName, medDiscr, medSideEff);
END$$

CREATE DEFINER=`admin`@`%` PROCEDURE `examsQuantity` (IN `examdate` DATE)  BEGIN
SELECT COUNT(*) FROM Examine WHERE date = examdate;
END$$

CREATE DEFINER=`admin`@`%` PROCEDURE `illnessPatients` (IN `PatientsDiagnosis` CHAR(64))  BEGIN
SELECT COUNT(*) FROM Examine WHERE diagnosis = PatientsDiagnosis;
END$$

CREATE DEFINER=`admin`@`%` PROCEDURE `showSideEffect` (IN `medName` TEXT)  BEGIN
SELECT side_effect FROM Medicine WHERE name = medName;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `Examine`
--

CREATE TABLE `Examine` (
  `id` int(11) NOT NULL,
  `diagnosis` char(64) NOT NULL,
  `patient` int(11) NOT NULL,
  `date` date NOT NULL,
  `place` char(28) NOT NULL,
  `symptoms` text NOT NULL,
  `medical_prescription` text NOT NULL,
  `doctors_name` char(48) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `Examine`
--

INSERT INTO `Examine` (`id`, `diagnosis`, `patient`, `date`, `place`, `symptoms`, `medical_prescription`, `doctors_name`) VALUES
(1, 'SARS', 1, '2022-01-02', 'Hospital', 'Hacking cough, fever, headache  ', 'Bed rest, worm drinking', 'Doctor House'),
(2, 'Compound fracture.', 3, '2021-11-01', 'Home', 'Leg pain after falling from the stairs', 'Bed rest. Set a plaster cast', 'Doctor House'),
(3, 'Pneumonia', 1, '2021-12-09', 'Hospital', 'Headache, fever, lung pain', 'Antibiotics. Bed rest.', 'Doctor House'),
(4, 'Otitis', 4, '2022-01-09', 'Hospital', 'After the cold weather Ear hurts ', 'Talking ear-drops', 'Doctor House');

-- --------------------------------------------------------

--
-- Структура таблицы `Medicine`
--

CREATE TABLE `Medicine` (
  `id` int(11) NOT NULL,
  `name` char(48) NOT NULL,
  `description` text NOT NULL,
  `side_effect` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `Medicine`
--

INSERT INTO `Medicine` (`id`, `name`, `description`, `side_effect`) VALUES
(1, 'Aspirin', 'Aspirin is used to reduce fever and relieve mild to moderate pain from conditions such as muscle aches, toothaches, common cold, and headaches. It may also be used to reduce pain and swelling in conditions such as arthritis. Aspirin is known as a salicylate and a nonsteroidal anti-inflammatory drug (NSAID). It works by blocking a certain natural substance in your body to reduce pain and swelling. Consult your doctor before treating a child younger than 12 years.Your doctor may direct you to take a low dose of aspirin to prevent blood clots. This effect reduces the risk of stroke and heart attack. If you have recently had surgery on clogged arteries (such as bypass surgery, carotid endarterectomy, coronary stent), your doctor may direct you to use aspirin in low doses as a \"blood thinner\" to prevent blood clots.', 'Conditions of excess stomach acid secretion. Irritation of the stomach or intestines. Nausea. Vomiting. Heartburn. Stomach cramps.'),
(2, 'Quinolone', 'Quinolones are a class of synthetic bactericidal antibiotics with broad-spectrum activity, which can inhibit both Gram-negative and Gram-positive bacteria, including anaerobes. They exert their activity by binding to the bacterial topoisomerase type II enzymes, interfering with the DNA synthesis pathway. Binding to the cleavage complex occurs via a water–metal ion bridge, which links the keto carbonyl group of quinolone indirectly to the serine and acidic residue of the enzymes mediated by a Mg2+ ion.', 'Gastrointestinal effects, Phototoxicity'),
(3, 'Fromilid', 'Fromilid Unoromycin film-coated tablets are indicated for the treatment of the following bacterial infections, when caused by Fromilid Unoromycin-susceptible bacteria.\r\n\r\n- Bacterial pharyngitis\r\n\r\n- Mild to moderate community acquired pneumonia\r\n\r\n- Acute bacterial sinusitis (adequately diagnosed)\r\n\r\n- Acute exacerbation of chronic bronchitis\r\n\r\n- Skin infections and soft tissue infections of mild to moderate severity,\r\n\r\n- In appropriate combination with antibacterial therapeutic regimens and an appropriate ulcer healing agent for the eradication of Helicobacter pylori in patients with Helicobacter pylori associated ulcers.\r\n\r\nConsideration should be given to official guidance on the appropriate use of antibacterial agents.', 'Diarrhea, nausea, vomiting, headache, and changes in taste');

-- --------------------------------------------------------

--
-- Структура таблицы `Patient`
--

CREATE TABLE `Patient` (
  `id` int(11) NOT NULL,
  `name` char(48) NOT NULL,
  `sex` char(1) NOT NULL,
  `date_of_Birth` date NOT NULL,
  `home_addres` char(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `Patient`
--

INSERT INTO `Patient` (`id`, `name`, `sex`, `date_of_Birth`, `home_addres`) VALUES
(1, 'Richard Brown', 'M', '1981-06-10', 'London, Bond street, 128'),
(3, 'Laura Evans', 'F', '1994-02-05', 'London, Oxford street 80E'),
(4, 'Alexandra Jonsoon', 'F', '1996-04-10', 'Birmingham, Kings street 25');

-- --------------------------------------------------------

--
-- Структура таблицы `Prescribed_medications`
--

CREATE TABLE `Prescribed_medications` (
  `id` int(11) NOT NULL,
  `way_of_using` text NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `examine_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `Prescribed_medications`
--

INSERT INTO `Prescribed_medications` (`id`, `way_of_using`, `medicine_id`, `examine_id`) VALUES
(1, 'Drink a full glass of water (8 ounces/240 milliliters). Do not lie down for at least 10 minutes after drug. \r\n\r\nSwallow enteric-coated tablets whole. Do not crush or chew enteric-coated tablets. ', 1, 1),
(2, 'Fromilid 500 mg twice daily in conjunction with amoxicillin 1000 mg twice daily and a proton-pump inhibitor in standard dose twice daily for 7 days.\r\n', 3, 3),
(3, 'Twice daily.', 2, 4);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Examine`
--
ALTER TABLE `Examine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Patient` (`patient`),
  ADD KEY `date` (`date`),
  ADD KEY `diagnosis` (`diagnosis`);

--
-- Индексы таблицы `Medicine`
--
ALTER TABLE `Medicine`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Индексы таблицы `Patient`
--
ALTER TABLE `Patient`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Prescribed_medications`
--
ALTER TABLE `Prescribed_medications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Medicine` (`medicine_id`),
  ADD KEY `Examine` (`examine_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Examine`
--
ALTER TABLE `Examine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Medicine`
--
ALTER TABLE `Medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `Patient`
--
ALTER TABLE `Patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `Prescribed_medications`
--
ALTER TABLE `Prescribed_medications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Examine`
--
ALTER TABLE `Examine`
  ADD CONSTRAINT `Examine_ibfk_1` FOREIGN KEY (`patient`) REFERENCES `Patient` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `Prescribed_medications`
--
ALTER TABLE `Prescribed_medications`
  ADD CONSTRAINT `Prescribed_medications_ibfk_1` FOREIGN KEY (`medicine_id`) REFERENCES `Medicine` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Prescribed_medications_ibfk_2` FOREIGN KEY (`examine_id`) REFERENCES `Examine` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
