<?php if(!defined('CMS_ROOT')) die;

/**
 * Flexo CMS - Content Management System. <http://flexo.up.dn.ua>
 * Copyright (C) 2008 Maslakov Alexander <jmas.ukraine@gmail.com>
 * Copyright (C) 2008 Philippe Archambault <philippe.archambault@gmail.com>
 * Copyright (C) 2008 Martijn van der Kleijn <martijn.niji@gmail.com>
 *
 * This file is part of Flexo CMS.
 *
 * Flexo CMS is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Flexo CMS is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Flexo CMS.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Flexo CMS has made an exception to the GNU General Public License for plugins.
 * See exception.txt for details and the full text.
 */

/**
 * @package Flexo
 * @subpackage plugins.page_images
 *
 * @author Maslakov Alexandr <jmas.ukraine@gmail.com>
 * @version 0.1
 * @license http://www.gnu.org/licenses/gpl.html GPL License
 * @copyright Maslakov Alexander, 2011
 */

/**
 *	Table structure for table: pi_image
 */
$PDO = Record::getConnection();
$driver = strtolower($PDO->getAttribute(Record::ATTR_DRIVER_NAME));

if ($driver == 'mysql')
{
	$PDO->exec('CREATE TABLE IF NOT EXISTS '.TABLE_PREFIX.'pi_image (
		id int(11) NOT NULL auto_increment,
		page_id int(11) NOT NULL,
		file_name varchar(256) NOT NULL,
		created_date datetime NOT NULL,
        description text,
        position int(11) NOT NULL,
		PRIMARY KEY (id)
	) ENGINE=MyISAM DEFAULT CHARSET=utf8');
}
else if ($driver == 'sqlite')
{
	$PDO->exec('CREATE TABLE IF NOT EXISTS pi_image (
		id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
		page_id int(11) NOT NULL,
		file_name varchar(256) NOT NULL,
		created_date datetime NOT NULL,
        description text,
        position int(11) NOT NULL
	)');
}

$dir_path = PUBLIC_ROOT.DIRECTORY_SEPARATOR.'page_images';

if (!is_dir($dir_path))
{
	mkdir($dir_path);
}