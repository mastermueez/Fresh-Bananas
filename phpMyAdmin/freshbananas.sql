-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 13, 2018 at 05:23 PM
-- Server version: 5.7.20
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freshbananas`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `about_id` int(10) NOT NULL,
  `about_us` text NOT NULL,
  `who_we_are` text NOT NULL,
  `our_name` text NOT NULL,
  `image` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`about_id`, `about_us`, `who_we_are`, `our_name`, `image`) VALUES
(1, 'Welcome to FreshBananas.com (actually demo5g.lictproject.com), soon to be the world\'s preeminent destination for movie criticism, commentary and community. It is with genuine excitement that we bring you this new site, the product of our Top up IT project for Web Development. We would like to acknowledge and extend our heartfelt gratitude to Pramod Yaduvanshi - our instructor, without whom none of this would have been possible.', 'BRACU students who should have started working on this project earlier because there is so much room for improvement.', 'The name Fresh Bananas was inspired from the most trusted recommendation sources for quality entertainment - Rotten Tomatoes. We vision this site to one day offer the most comprehensive guide to whats fresh and hence the name. (The former is true, the latter is not.)', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aboutcomments`
--

CREATE TABLE `aboutcomments` (
  `aboutcomment_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `about_id` int(10) NOT NULL,
  `comment` text NOT NULL,
  `date_posted` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aboutcomments`
--

INSERT INTO `aboutcomments` (`aboutcomment_id`, `user_id`, `about_id`, `comment`, `date_posted`) VALUES
(6, 8, 1, 'fake complimentary comment 1', '2018-03-30'),
(7, 9, 1, 'fake complimentary comment 2', '2018-03-30');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `name`, `email`, `password`) VALUES
(1, 'Abdul Mueez', 'mueezdhaka@gmail.com', 'notsecureatall'),
(2, 'demo5glictprojec', 'email@demo5g.lictproject.com', 'ku.LcKGx_aQ7');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `review_id` int(10) NOT NULL,
  `comment` text NOT NULL,
  `date_posted` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `review_id`, `comment`, `date_posted`) VALUES
(17, 1, 13, '$sh!t movie', '2018-03-30'),
(18, 7, 13, 'expected better', '2018-03-30'),
(19, 8, 16, 'so good', '2018-03-30');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre_id` int(10) NOT NULL,
  `movie_id` int(10) DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `release_date` date DEFAULT NULL,
  `runtime` int(10) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `release_date`, `runtime`, `link`, `image`) VALUES
(38, 'Black Panther', '2018-01-29', 135, 'https://www.youtube.com/embed/xjDjIWPwcPU', 'Black_Panther.jpg'),
(39, 'Blade Runner 2049', '2017-10-13', 164, 'https://www.youtube.com/embed/gCcx85zbxz4', 'blade-runner-2049-poster-5.jpg'),
(40, 'Dunkirk', '2017-07-13', 106, 'https://www.youtube.com/embed/F-eMt3SrfFU', 'dunkirk_ver2_xlg.jpg'),
(41, 'Avengers: Infinity War', '2018-04-25', 156, 'https://www.youtube.com/embed/6ZfuNTqbHE8', 'infinity wars.jpg'),
(42, 'Justice League', '2017-11-15', 120, 'https://www.youtube.com/embed/r9-DM9uBtVI', 'justice-league-superman-poster.jpg'),
(43, 'Lady Bird', '2017-11-03', 95, 'https://www.youtube.com/embed/cNi_HC839Wo', 'lady_bird_ver2_xlg.jpg'),
(44, 'Logan', '2017-03-01', 141, 'https://www.youtube.com/embed/Div0iP65aZo', 'logan-poster-3.jpg'),
(45, 'Thor: Ragnarok', '2017-10-10', 130, 'https://www.youtube.com/embed/v7MGUNV8MxU', 'movie1.jpg'),
(46, 'Star Wars: The Last Jedi', '2017-12-09', 152, 'https://www.youtube.com/embed/Q0CbN8sfihY', 'movie3.jpg'),
(47, 'Red Sparrow', '2018-02-28', 141, 'https://www.youtube.com/embed/PmUL6wMpMWw', 'new-poster-and-photos-for-jennifer-lawrences-russian-assassin-thriller-red-sparrow1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `Review_ID` int(10) NOT NULL,
  `Movie_ID` int(10) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `description` text,
  `image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`Review_ID`, `Movie_ID`, `heading`, `description`, `image`) VALUES
(11, 39, 'Blade Runner 2049: our spoiler-free review', 'Itâ€™s been 35 years since Ridley Scottâ€™s Blade Runner hit theaters, and when it takes this long for a sequel to roll around, a few questions need to be answered. No question is more important than â€œwhy?â€ Yes, weâ€™re in a cultural moment where nearly everything is a sequel, prequel, reboot, or spinoff, but Scottâ€™s dystopian film never organically called for a follow-up the way some films do. Itâ€™s a neo-noir thriller with an open ending, but from a character and thematic perspective, Scott neatly sewed up the story. Rick Deckard (Harrison Ford), an android hunter known as a â€œblade runner,â€ learns that all life has some sort of value. Tired of killing others, he decides to go on the run with his android lover Rachael (Sean Young).\r\n\r\nThat leaves Denis Villeneuveâ€™s Blade Runner 2049 with a pretty steep hill to climb. The sequel has to live up to the unforgettable visual style of Scottâ€™s film, while simultaneously forging its own identity, and defending its reason for existing in the first place. Turnkey action sequels are fine for comic book movies, but a distinctive classic like Blade Runner demands an entirely different standard.\r\n\r\nThe good news is that Villeneuveâ€™s film is every bit the originalâ€™s equal when it comes to breathtaking visuals and design, and Ryan Gosling is perfectly cast as K, the newest blade runner on the hunt for renegade â€œskin jobs.â€ The film ultimately doesnâ€™t have the resonance and pure invention of the original, and over its nearly three-hour run time, that becomes increasingly clear. But itâ€™s certainly not for lack of trying.', 'TRI-13668_2040.0.jpg'),
(12, 40, 'Dunkirk review: heart-hammering and heroically British, this is Christopher Nolan at the peak of his powers', 'Dir: Christopher Nolan; Starring: Fionn Whitehead, Aneurin Barnard, Harry Styles, Mark Rylance, Tom Glynn-Carney, Barry Keoghan, Tom Hardy, Cillian Murphy, Jack Lowden, James Dâ€™Arcy, Kenneth Branagh. 12A cert, 106 mins.\r\n\r\nOf the many things that stun and convulse you in Dunkirk, the smallest might have the most lasting impact. Early on, as the camera surveys the British soldiers stood along the French shoreline in thin, straggling columns, one thought â€“ theyâ€™re so young â€“ jams in your head like a door stop, and gets driven in harder with every passing minute. \r\n\r\nChristopher Nolanâ€™s astonishing new film, a retelling of the Allied evacuation of occupied France in 1940, is a work of heart-hammering intensity and grandeur that demands to be seen on the best and biggest screen within reach. But its spectacle doesnâ€™t stop at the recreations of Second World War combat.', 'maxresdefault.jpg'),
(13, 42, 'Justice League has something for everyone â€” and no way to fit it all together', 'Itâ€™s probably a mistake to ascribe any sort of grand strategy to Justice League, Warner Brothersâ€™ latest superhero film made in conjunction with DC Entertainment. The film is necessarily a clash of multiple personal visions and multiple corporate ones: original director Zack Snyder stepped down from the film after a family suicide, and Joss Whedon stepped in to complete the movie, stitching together Snyderâ€™s footage via months of extra reshoots to add character-building and comedy. And Warner certainly had to be aware that Snyderâ€™s grand scheme for the DC Extended Universe â€” DCâ€™s rushed attempt to catch up with Marvelâ€™s nearly decade-old movie franchise â€” has been unpopular with critics and has underperformed with fans, until Wonder Woman director Patty Jenkins stepped in with a film that matched the color scheme of Snyderâ€™s films with a lighter tone and a more human outlook. The pressure to follow Wonder Womanâ€™s example (or at the very least, to insert more Wonder Woman into Justice League) must have been fierce, after that movieâ€™s success in the wake of the derisive response to DCâ€™s Suicide Squad. Justice League does feel like a film with too many hands pulling in too many directions.', 'MV5BMjQwODk2Nzg0M15BMl5BanBnXkFtZTgwNTA2NDAxNDM_._V1_SY1000_CR0_0_1481_1000_AL_.0.jpg'),
(14, 43, 'Greta Gerwigâ€™s Exquisite, Flawed â€œLady Birdâ€', 'That Greta Gerwig is a brilliant writer has been clear since the very start of her movie career, because the films in which she first starred, such as â€œHannah Takes the Stairsâ€ and â€œYeast,â€ were already her feats of writing. Her dialogue in those films was mostly improvised, but itâ€™s vastly superior to the texts of many acclaimed screenwriters. Other films that she has written, â€œFrances Haâ€ and â€œMistress America,â€ are as readable as they are watchable. And her new film, â€œLady Birdâ€â€”the first feature that she has directed alone, the first to be fully scripted, the first to be made on a substantial budget with a large and professional cast and crewâ€”is full of exquisite dialogue. The experience of watching it for review is the experience of scribbling in the dark as fast as humanly possible, not only to be able to quote it and describe it but, above all, to be able to savor it.\r\n\r\nIn â€œLady Bird,â€ Gerwig tells a coming-of-age story for a young woman in Sacramento, set between the fall of 2002 and the fall of 2003, thatâ€™s loosely autobiographical, cognate with very general aspects of her life. Gerwig, like the filmâ€™s protagonist, Christine â€œLady Birdâ€ McPherson (played by Saoirse Ronan), grew up in Sacramento, attended a Catholic high school, and went to New York for college. But whatâ€™s most significantly personal about â€œLady Birdâ€ isnâ€™t the setup but the detailsâ€”the emotional world of its characters, the touches of whimsy and grace with which she creates it.', 'Brody-Ladybird.jpg'),
(16, 44, 'This is How Wolverine Was Supposed To End', 'WHEN WOLVERINE FIRST appears in Logan, he\'s graying and tired. His claws get stuck between his knuckles and have lost their snikt-snikt responsiveness. He\'s suicidal and he\'s drinking too much, even for him. Guys he normally would have taken out with a quickness can get him on his back. He looks like shit and because this is R-rated Wolverine, he can say so.\r\n\r\nYes, everything you\'ve heard is true. That rage-filled, drunk, foul-mouthed Logan who never got to fully surface in the previous X-Men movies is finally joining his buddy Deadpool in the world of grown-up cinema. And it\'s the perfect way for him to end his run.', '17-logan.w600.h315.2x.jpg'),
(17, 45, 'The Overdue Comedy of Thor: Ragnarok', 'When Marvel Studios released the original Thor in 2011, it was their trickiest franchise to date: This time the hero was not an irradiated Earthling or a guy in a metal suit, but a surfer-blond extraterrestrial who also happened to be a Norse god with a magic hammer.\r\n\r\nWisely, the studio chose to forego (as the comic eventually had) his alter ego as a hobbled physician with a walking stick that could suddenly make himâ€”boom!â€” the God of Thunder. (Way too Shazam.) But the Thor franchise has been a balancing act from the start. The first film had the mildly Shakespearian vibe that one might have expected from its director, Kenneth Branagh; the second capitalized on the realization that its titular hero, played by Chris Hemsworth, was less compelling than his Asgardian adopted brother and nemesis, Loki (Tom Hiddleston).\r\n\r\nBut it wasnâ€™t until 2014â€™s Guardians of the Galaxy that Marvel came upon a true model for Thor moving forward. Forget the ridiculousness of Norsemen from outer space: Guardians offered up an ambulatory houseplant and a talking raccoon, and leaned hard into the absurdity of both. As a result, we now have Thor: Ragnarok, which is perfectly acceptable as an action movie but moderately inspired as a comedy. (This may well be the future of the entire superhero genreâ€”see also: Spider-Man: Homecomingâ€”which means that DC Comics and Warner Bros. will probably catch on in about five years.)', 'lead_960.jpg'),
(18, 46, 'The Last Jedi came thrillingly close to upending Star Wars â€” but lost its nerve', 'The Last Jedi is one of the best movies in the Star Wars franchise, for much the same reason The Empire Strikes Back is one of the best. Where the first movie in a trilogy is a thrilling adventure â€” 2015â€™s The Force Awakens mirrors A New Hope almost beat-for-beat in that respect â€” the second complicates the saga by introducing doubt, failure, and sadness.\r\n\r\nThat often upsets fans. There is tension between the narrative demands of a second film and making a Star Wars movie that does big business, sells toys, and makes fans happy. But adding darkness infuses a well-done second film with depth that endures over the long term.\r\n\r\nFans are indeed upset with many of director Rian Johnsonâ€™s choices in The Last Jedi, as Voxâ€™s Todd VanDerWerff has documented in detail. (Likewise, The Empire Strikes Back faced a backlash of its own.) And it is often the choices that complicate franchise canon and characters that have stirred up the most anger.\r\n\r\nMy criticism is different, though, and something I havenâ€™t seen articulated in reviews of the film. In almost every case, I thought Johnson didnâ€™t go far enough. He feints and flirts with deeper, darker themes, but again and again, loses his nerve before the tone and trajectory of the saga are seriously threatened.', 'finnrosejedi__1_.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `test_id` int(10) NOT NULL,
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`) VALUES
(1, 'Minion 1', 'minion1@freshbananas.com', '123'),
(6, 'Minion 2', 'minion2@freshbananas.com', '123'),
(7, 'Minion 3', 'minion3@freshbananas.com', '123'),
(8, 'Minion 4', 'minion4@freshbananas.com', '123'),
(9, 'Minion 5', 'minion5@freshbananas.com', '123'),
(10, 'gdg', 'fasfas@gmail.com', 'root'),
(11, 'wata', 'atatt@teg.com', 'root'),
(12, 'mueez', 'master.mueez@gmail.com', 'root'),
(13, 'hash test', 'h@h.com', 'root'),
(14, 'rwrtw', 'rwrwq@fesfgs.com', '123'),
(15, 'faf', 'afa@com', '123'),
(16, 'rqr', 'qrq@com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`about_id`);

--
-- Indexes for table `aboutcomments`
--
ALTER TABLE `aboutcomments`
  ADD PRIMARY KEY (`aboutcomment_id`),
  ADD KEY `about_id` (`about_id`),
  ADD KEY `aboutcomments_ibfk_1` (`user_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `review_id` (`review_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`Review_ID`),
  ADD KEY `Movie_ID` (`Movie_ID`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `about_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `aboutcomments`
--
ALTER TABLE `aboutcomments`
  MODIFY `aboutcomment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `Review_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `test_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aboutcomments`
--
ALTER TABLE `aboutcomments`
  ADD CONSTRAINT `aboutcomments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`Review_ID`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`Movie_ID`) REFERENCES `movies` (`movie_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
