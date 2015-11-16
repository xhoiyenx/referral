-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2015 at 11:26 AM
-- Server version: 5.6.25
-- PHP Version: 5.5.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `referral`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` tinyint(3) unsigned NOT NULL,
  `code` char(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and/or Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People''s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People''s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(127, 'LU', 'Luxembourg'),
(127, 'MO', 'Macau'),
(127, 'MK', 'Macedonia'),
(127, 'MG', 'Madagascar'),
(127, 'MW', 'Malawi'),
(127, 'MY', 'Malaysia'),
(127, 'MV', 'Maldives'),
(127, 'ML', 'Mali'),
(127, 'MT', 'Malta'),
(127, 'MH', 'Marshall Islands'),
(127, 'MQ', 'Martinique'),
(127, 'MR', 'Mauritania'),
(127, 'MU', 'Mauritius'),
(127, 'TY', 'Mayotte'),
(127, 'MX', 'Mexico'),
(127, 'FM', 'Micronesia, Federated States of'),
(127, 'MD', 'Moldova, Republic of'),
(127, 'MC', 'Monaco'),
(127, 'MN', 'Mongolia'),
(127, 'ME', 'Montenegro'),
(127, 'MS', 'Montserrat'),
(127, 'MA', 'Morocco'),
(127, 'MZ', 'Mozambique'),
(127, 'MM', 'Myanmar'),
(127, 'NA', 'Namibia'),
(127, 'NR', 'Nauru'),
(127, 'NP', 'Nepal'),
(127, 'NL', 'Netherlands'),
(127, 'AN', 'Netherlands Antilles'),
(127, 'NC', 'New Caledonia'),
(127, 'NZ', 'New Zealand'),
(127, 'NI', 'Nicaragua'),
(127, 'NE', 'Niger'),
(127, 'NG', 'Nigeria'),
(127, 'NU', 'Niue'),
(127, 'NF', 'Norfolk Island'),
(127, 'MP', 'Northern Mariana Islands'),
(127, 'NO', 'Norway'),
(127, 'OM', 'Oman'),
(127, 'PK', 'Pakistan'),
(127, 'PW', 'Palau'),
(127, 'PS', 'Palestine'),
(127, 'PA', 'Panama'),
(127, 'PG', 'Papua New Guinea'),
(127, 'PY', 'Paraguay'),
(127, 'PE', 'Peru'),
(127, 'PH', 'Philippines'),
(127, 'PN', 'Pitcairn'),
(127, 'PL', 'Poland'),
(127, 'PT', 'Portugal'),
(127, 'PR', 'Puerto Rico'),
(127, 'QA', 'Qatar'),
(127, 'RE', 'Reunion'),
(127, 'RO', 'Romania'),
(127, 'RU', 'Russian Federation'),
(127, 'RW', 'Rwanda'),
(127, 'KN', 'Saint Kitts and Nevis'),
(127, 'LC', 'Saint Lucia'),
(127, 'VC', 'Saint Vincent and the Grenadines'),
(127, 'WS', 'Samoa'),
(127, 'SM', 'San Marino'),
(127, 'ST', 'Sao Tome and Principe'),
(127, 'SA', 'Saudi Arabia'),
(127, 'SN', 'Senegal'),
(127, 'RS', 'Serbia'),
(127, 'SC', 'Seychelles'),
(127, 'SL', 'Sierra Leone'),
(127, 'SG', 'Singapore'),
(127, 'SK', 'Slovakia'),
(127, 'SI', 'Slovenia'),
(127, 'SB', 'Solomon Islands'),
(127, 'SO', 'Somalia'),
(127, 'ZA', 'South Africa'),
(127, 'GS', 'South Georgia South Sandwich Islands'),
(127, 'ES', 'Spain'),
(127, 'LK', 'Sri Lanka'),
(127, 'SH', 'St. Helena'),
(127, 'PM', 'St. Pierre and Miquelon'),
(127, 'SD', 'Sudan'),
(127, 'SR', 'Suriname'),
(127, 'SJ', 'Svalbard and Jan Mayen Islands'),
(127, 'SZ', 'Swaziland'),
(127, 'SE', 'Sweden'),
(127, 'CH', 'Switzerland'),
(127, 'SY', 'Syrian Arab Republic'),
(127, 'TW', 'Taiwan'),
(127, 'TJ', 'Tajikistan'),
(127, 'TZ', 'Tanzania, United Republic of'),
(127, 'TH', 'Thailand'),
(127, 'TG', 'Togo'),
(127, 'TK', 'Tokelau'),
(127, 'TO', 'Tonga'),
(127, 'TT', 'Trinidad and Tobago'),
(127, 'TN', 'Tunisia'),
(127, 'TR', 'Turkey'),
(127, 'TM', 'Turkmenistan'),
(127, 'TC', 'Turks and Caicos Islands'),
(127, 'TV', 'Tuvalu'),
(127, 'UG', 'Uganda'),
(127, 'UA', 'Ukraine'),
(127, 'AE', 'United Arab Emirates'),
(127, 'GB', 'United Kingdom'),
(127, 'US', 'United States'),
(127, 'UM', 'United States minor outlying islands'),
(127, 'UY', 'Uruguay'),
(127, 'UZ', 'Uzbekistan'),
(127, 'VU', 'Vanuatu'),
(127, 'VA', 'Vatican City State'),
(127, 'VE', 'Venezuela'),
(127, 'VN', 'Vietnam'),
(127, 'VG', 'Virgin Islands (British)'),
(127, 'VI', 'Virgin Islands (U.S.)'),
(127, 'WF', 'Wallis and Futuna Islands'),
(127, 'EH', 'Western Sahara'),
(127, 'YE', 'Yemen'),
(127, 'YU', 'Yugoslavia'),
(127, 'ZR', 'Zaire'),
(127, 'ZM', 'Zambia'),
(127, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` mediumint(8) unsigned NOT NULL,
  `role_id` tinyint(3) unsigned NOT NULL,
  `fullname` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usermail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` char(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `activation_code` char(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `online` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `logged_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `logout_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role_id`, `fullname`, `username`, `usermail`, `password`, `status`, `activation_code`, `remember_token`, `online`, `logged_at`, `logout_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'Hoiyen', 'admin', 'hoiyen.2000@gmail.com', '$2y$10$G.23wXMeXoUdJGAle7GCWO1J4p8fWRLtAooKD8J1Bvj.w4armxr6S', '1', '$2y$10$ZoIVCZUmOcxt/SAGtnPF/u7TZSBZ1POAwIrRUXrxz2hS8MKzd2UeW', 'swc5y6QZz7vTEZj19AD47T7xHxZznJMuENFxPqOJNGx7wzGxRkDEYkvwLdQK', '0', '2015-11-16 09:02:45', '2015-11-16 09:04:00', '2015-11-15 07:08:12', '2015-11-16 09:04:00'),
(2, 2, 'Lo Hoi Yen', 'hoiyen', 'hoiyen@itconcept.sg', '$2y$10$bVsSyakOLjbQU2As4gSMvu4gCe0yzCZ49yXFTm8vgxogqFllNol5y', '1', '$2y$10$u9iZw46jHeniLW0Z0DsOK.Uj.AneXFgB30SLqV/q.Ka1rImq.OiZu', 'm3SNSUdELXr2FYFRW0Ps2pOHMz5fdUnhsA51RZwcJGxCvGxzCtHR2hCbRtki', '1', '2015-11-16 09:23:32', '0000-00-00 00:00:00', '2015-11-15 09:58:24', '2015-11-16 09:23:32');

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE IF NOT EXISTS `user_meta` (
  `id` int(10) unsigned NOT NULL,
  `user_id` mediumint(8) unsigned NOT NULL,
  `attr` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_meta`
--

INSERT INTO `user_meta` (`id`, `user_id`, `attr`, `value`) VALUES
(1, 1, 'address', 'Jl. Pengukiran 4 No 48, Pejagalan | RT/RW : 005/002'),
(2, 1, 'zipcode', '11240'),
(3, 1, 'country', 'ID'),
(4, 2, 'address', 'Jl Pengukiran 4 No 34'),
(5, 2, 'zipcode', '11240'),
(6, 2, 'country', 'ID');

-- --------------------------------------------------------

--
-- Table structure for table `user_password_reminder`
--

CREATE TABLE IF NOT EXISTS `user_password_reminder` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_relation`
--

CREATE TABLE IF NOT EXISTS `user_relation` (
  `id` mediumint(8) unsigned NOT NULL,
  `user_id` mediumint(8) unsigned NOT NULL,
  `lead_id` mediumint(8) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` tinyint(3) unsigned NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `name`, `code`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'administrator', 'This is administrator', '2015-11-13 15:07:10', '2015-11-13 15:07:10'),
(2, 'Member', 'member', 'This is member', '2015-11-13 15:07:10', '2015-11-13 15:07:10'),
(3, 'Lead', 'lead', 'This is prospect', '2015-11-13 15:07:34', '2015-11-13 15:07:34');

-- --------------------------------------------------------

--
-- Table structure for table `user_role_permission`
--

CREATE TABLE IF NOT EXISTS `user_role_permission` (
  `id` mediumint(8) unsigned NOT NULL,
  `role_id` tinyint(3) unsigned NOT NULL,
  `permission` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`usermail`);

--
-- Indexes for table `user_meta`
--
ALTER TABLE `user_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_password_reminder`
--
ALTER TABLE `user_password_reminder`
  ADD KEY `user_password_reminder_email_index` (`email`(191)),
  ADD KEY `user_password_reminder_token_index` (`token`(191));

--
-- Indexes for table `user_relation`
--
ALTER TABLE `user_relation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role_permission`
--
ALTER TABLE `user_role_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission` (`permission`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_meta`
--
ALTER TABLE `user_meta`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user_relation`
--
ALTER TABLE `user_relation`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_role_permission`
--
ALTER TABLE `user_role_permission`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
