<?php
/* Copyright (c) 2015 by the Omnicoin Team.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>. */

// Disallow direct access to this file for security reasons
if (!defined("IN_MYBB")) {
	die("Direct initialization of this file is not allowed.");
}

// Hooks
$plugins->add_hook("member_profile_start", "buysigs_member_profile_start");

function buysigs_info() {
	return array(
		"name"		=> "Omnicoin Signature Seller",
		"description"	=> "This plugin allows automatic management of signature sales for merchants",
		"website"	=> "http://www.omnicoin.org",
		"author"	=> "Omnicoin Team",
		"authorsite"	=> "https://github.com/Omnicoin-Project/Omnicoin/wiki/Omnicoin-Team",
		"version"	=> "v1.0.0",
		"guid" 		=> "",
		"compatibility" => "*"
	);
}

function buysigs_install() {
	//Called whenever a plugin is installed by clicking the "Install" button in the plugin manager.
	//It is common to create required tables, fields and settings in this function.	
}

function buysigs_is_installed() {
	//Called on the plugin management page to establish if a plugin is already installed or not.
	//This should return TRUE if the plugin is installed (by checking tables, fields etc) or FALSE if the plugin is not installed.
  	return false;
}

function buysigs_uninstall() {
	//Called whenever a plugin is to be uninstalled. This should remove ALL traces of the plugin from the installation (tables etc). If it does not exist, uninstall button is not shown.
}

function buysigs_activate() {
	//Called whenever a plugin is activated via the Admin CP. This should essentially make a plugin "visible" by adding templates/template changes, language changes etc.
}

function buysigs_deactivate() {
	//Called whenever a plugin is deactivated. This should essentially "hide" the plugin from view by removing templates/template changes etc. It should not, however, remove any information such as tables, fields etc - that should be handled by an _uninstall routine. When a plugin is uninstalled, this routine will also be called before _uninstall() if the plugin is active.
}

/*
Add function to prevent an active status sold signature to be altered.


----------------------------
Database Scheme:

Table Name:sigsales (for the listing of sales)
Columns:
id
uid
price (in omc of course)
length (will be sold in days)
status (0=open listing, 1=sold, 2=expired)

Table Name: sigbuys (for the sales, saving and replacing of sigs)
Columns:
id
uid_seller
uid_buyer
oldsig
newsig
status (0=active, 1=expired)
buydate (use unix dateline time)
expdate (use unix dateline time)
txnid (omc sales transaction id)
*/