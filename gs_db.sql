-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2022 年 12 月 15 日 15:58
-- サーバのバージョン： 10.4.21-MariaDB
-- PHP のバージョン: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_an_table`
--

CREATE TABLE `gs_an_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_an_table`
--

INSERT INTO `gs_an_table` (`id`, `name`, `email`, `content`, `date`) VALUES
(1, '松山', 'ai@gmail.com', '内容', '2022-12-11 10:41:17'),
(2, 'とみた', 'tomi@gmail.com', '内容ああ', '2022-12-11 10:44:46'),
(3, '1', '1', '1', '2022-12-11 11:35:12'),
(4, '1', '1', '', '2022-12-11 11:41:49'),
(5, '1', '1', 'あああ', '2022-12-15 22:06:30');

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bm_table`
--

CREATE TABLE `gs_bm_table` (
  `id` int(12) NOT NULL,
  `bookName` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bookAuthors` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bookUrl` text COLLATE utf8_unicode_ci NOT NULL,
  `bookRate` int(2) NOT NULL,
  `bookComment` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `gs_bm_table`
--

INSERT INTO `gs_bm_table` (`id`, `bookName`, `bookAuthors`, `bookUrl`, `bookRate`, `bookComment`, `date`) VALUES
(21, '『きみのことがだいすき』', 'いぬいさえこ', 'http://books.google.co.jp/books?id=eUHezgEACAAJ&dq=intitle:%E3%81%8D%E3%81%BF%E3%81%AE%E3%81%93%E3%81%A8%E3%81%8C%E3%81%A0%E3%81%84%E3%81%99%E3%81%8D+inauthor:%E3%81%84%E3%81%AC%E3%81%84&hl=&source=gbs_api', 5, '絵も内容もほんわかあったかな愛情で包み込むような優しい絵本です', '2022-12-15 23:52:40'),
(22, '『パンどろぼう』', '柴田ケイコ', 'http://books.google.co.jp/books?id=RS-HzQEACAAJ&dq=intitle:%E3%83%91%E3%83%B3%E3%81%A9%E3%82%8D%E3%81%BC%E3%81%86+inauthor:%E6%9F%B4%E7%94%B0&hl=&source=gbs_api', 5, '始めはあまりかわいいとも思えなかった絵でしたが、繰り返し読んでいるとだんだんハマっていきました。お話はすごく面白いです。', '2022-12-15 23:54:37'),
(23, '『はらぺこあおむし』', 'カール,E.(エリック)', 'http://books.google.co.jp/books?id=USQupwAACAAJ&dq=intitle:%E3%81%AF%E3%82%89%E3%81%BA%E3%81%93%E3%81%82%E3%81%8A%E3%82%80%E3%81%97+inauthor:%E3%82%A8%E3%83%AA%E3%83%83%E3%82%AF&hl=&source=gbs_api', 3, '私が小さい頃から読んでた絵本。いまだに子供たちに人気で、さすがすぎる。', '2022-12-15 23:55:27'),
(24, '『だるまさんが』', 'かがくいひろし', 'http://books.google.co.jp/books?id=hWqLSgAACAAJ&dq=intitle:%E3%81%A0%E3%82%8B%E3%81%BE%E3%81%95%E3%82%93%E3%81%8C+inauthor:%E3%81%B2%E3%82%8D%E3%81%97&hl=&source=gbs_api', 4, '7ヶ月の娘がこのシリーズが好きなので購入。読み聞かせると喜んで聞いてくれます。', '2022-12-15 23:57:01');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_an_table`
--
ALTER TABLE `gs_an_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `gs_an_table`
--
ALTER TABLE `gs_an_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- テーブルの AUTO_INCREMENT `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
