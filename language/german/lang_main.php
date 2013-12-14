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
	'gb_usermenu_guildbank'			=> "Gildenbank",

	// Admin Menu
	'gb_adminmenu_guildbank'		=> "Gildenbank",

	//guildbank
	'gb_banker'						=> "Bankier",
	'gb_not_avail'					=> "n.v.",
	'gb_all_bankers'				=> "Alle Banken",
	'gb_total_bankers'				=> "Vermögen aller Banken",
	'gb_mainchar_out'				=> "Hauptcharakter",
	'gb_no_bankchar'				=> 'Keiner',
	'gb_update'						=> 'Letzte Aktivität',

	// manage_banker
	'manage_bankers'				=> 'Gilden-Bankiers verwalten',
	'confirm_delete_bankers'		=> "Sollen die Bankiers %s gelöscht werden?",
	'banker_mainchar'				=> 'Bank-Charakter',
	'money'							=> 'Guthaben',

	// add/edit banker
	'gb_add_item_title'				=> 'Gegenstand zum Bankkonto hinzufügen',
	'gb_edit_item_title'			=> 'Gegenstand bearbeiten',
	'gb_item_name'					=> "Gegenstand",
	'gb_rarity'						=> 'Gegenstandslevel',
	'gb_type'						=> "Gegenstandsart",
	'gb_dkp'						=> "DKP",
	'gb_amount'						=> "Menge",
	'rb_additem_button'				=> 'Gegenstand speichern',
	'rb_edititem_button'			=> 'Gegenstand ändern',

	// settings
	'gb_header_global'				=> "Gildenbank Einstellungen",
	'gb_hide_banker'				=> "Nur aktiven Bankier anzeigen",
	'gb_hide_banker_help'			=> "Andere Banker nach Auswahl eines Bankers verstecken",
	'gb_hide_money'					=> "Zeige Bankvermögen",
	'gb_hide_money_help'			=> "Zeige Bankvermögen (wenn aus: Keine Goldanzeige)",
	'gb_no_banker'					=> "Alle Banken zusammenfassen",
	'gb_no_banker_help'				=> "Fasse alle Banken in einer Bank zusammen",
	'gb_saved'						=> "Die Einstellungen wurden erfolgreich gespeichert",
	'gb_auto_adjust'				=> "Automatische DKP Korrektur bei Itemvergabe",
	'gb_auto_adjust_help'			=> "Vergebe eine automatische DKP Korrektur bei Itemvergabe",
	'gb_show_tooltip'				=> "Zeige Info-Tooltips",
	'gb_show_tooltip_help'			=> "keine Ahnung was da stut ;)",

	//filter translations
	'gb_filter_banker'				=> "Bankier auswählen",
	'gb_filter_type'				=> "Gegenstandsart auswählen",
	'gb_filter_rarity'				=> "Gegenstandslevel auswählen",

	// filters
	'gb_a_type'						=> array(
		'quest'		=> "Quest",
		'weapon'	=> "Waffe",
		'reagent'	=> "Reagenz",
		'builder'	=> "Handwerkswaren",
		'armor'		=> "Rüstung",
		'key'		=> "Schlüssel",
		'useable'	=> "Verbrauchbar",
		'misc'		=> "Verschiedenes"
	),
	'gb_a_rarity'					=> array(
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
