<?php
/*
 * Project:     EQdkp GuildBank
 * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:        http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:       2005
 * Date:        $Date$
 * -----------------------------------------------------------------------
 * @author      $Author$
 * @copyright   2005-2014 Wallenium
 * @link        http://eqdkp-plus.com
 * @package     guildbank
 * @version     $Rev$
 *
 * $Id$
 */

if (!defined('EQDKP_INC'))
{
    header('HTTP/1.0 404 Not Found');exit;
}

$lang = array(
	'guildbank'						=> "Gildenbank",
	'guildbank_short_desc'			=> 'Banken des Raids verwalten',
	'guildbank_long_desc'			=> 'Gildenbank ist ein Plugin um Raidbanken zu verwalten.',
	'guildbank_not_installed'		=> 'Gildenbank ist nicht installiert.',

	// User Menu
	'rb_usermenu_guildbank'			=> "Gildenbank",

	// Admin Menu
	'rb_adminmenu_guildbank'		=> "Gildenbank",

	//guildbank
	'rb_Bank_Items'					=> "Gegenstände auf der Bank",
	'rb_Banker'						=> "Bankier",
	'rb_all_Banker'					=> "Alle Bankiers",
	'rb_not_avail'					=> "n.v.",
	'rb_Item_Name'					=> "Gegenstand",
	'rb_Bank_Type'					=> "Art",
	'rb_Bank_QTY'					=> "Menge",
	'rb_Bank_Quality'				=> "Qualität",
	'rb_AllBankers'					=> "Alle Banken",
	'rb_TotBankers'					=> "Vermögen aller Banken",
	'rb_mainchar_out'				=> "Hauptcharakter",
	'rb_no_bankchar'				=> 'Keiner',

	// manage_banker
	'manage_bankers'				=> 'Gilden-Bankiers verwalten',
	'confirm_delete_bankers'		=> "Sollen die Bankiers %s gelöscht werden?",
	'banker_mainchar'				=> 'Bank-Charakter',
	'money'							=> 'Guthaben',

	// settings
	'rb_header_global'				=> "Gildenbank Einstellungen",
	'rb_hide_banker'				=> "Nur aktiven Bankier anzeigen",
	'rb_hide_banker_help'			=> "Andere Banker nach Auswahl eines Bankers verstecken",
	'rb_hide_money'					=> "Zeige Bankvermögen",
	'rb_hide_money_help'			=> "Zeige Bankvermögen (wenn aus: Keine Goldanzeige)",
	'rb_no_banker'					=> "Alle Banken zusammenfassen",
	'rb_no_banker_help'				=> "Fasse alle Banken in einer Bank zusammen",
	'rb_saved'						=> "Die Einstellungen wurden erfolgreich gespeichert",
	'rb_auto_adjust'				=> "Automatische DKP Korrektur bei Itemvergabe",
	'rb_auto_adjust_help'			=> "Vergebe eine automatische DKP Korrektur bei Itemvergabe",
	'rb_show_tooltip'				=> "Zeige Info-Tooltips",
	'rb_show_tooltip_help'			=> "keine Ahnung was da stut ;)",

	//filter translations
	'rb_filter_banker'				=> "Bankier auswählen",
	'rb_filter_type'				=> "Gegenstandsart auswählen",
	'rb_filter_rarity'				=> "Gegenstandslevel auswählen",

	// filters
	'rb_a_type'						=> array(
		'quest'		=> "Quest",
		'weapon'	=> "Waffe",
		'reagent'	=> "Reagenz",
		'builder'	=> "Handwerkswaren",
		'armor'		=> "Rüstung",
		'key'		=> "Schlüssel",
		'useable'	=> "Verbrauchbar",
		'misc'		=> "Verschiedenes"
	),
	'rb_a_rarity'					=> array(
		'5'			=> "Legendär",
		'4'			=> "Episch",
		'3'			=> "Rar",
		'2'			=> "Normal",
		'1'			=> "Rest"
	),

	// credits
	'guildbank_credits'			=> "Gildenbank %s",
);
?>
