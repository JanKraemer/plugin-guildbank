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
	'gb_tab_transactions'			=> 'Transaktionen',
	'gb_tab_items'					=> 'Gegenstände',

	// manage_banker
	'manage_bankers'				=> 'Gilden-Bankiers verwalten',
	'confirm_delete_bankers'		=> "Sollen die Bankiers %s gelöscht werden?",
	'banker_mainchar'				=> 'Bank-Charakter',
	'money'							=> 'Guthaben',

	// manage transactions
	'gb_manage_bank_items_title'	=> "Gegegnstände des Bankiers '%s' bearbeiten",
	'gb_manage_bank_items'			=> "Bankgegegnstände bearbeiten",
	'gb_mode'						=> 'Modus',
	'gb_a_mode'					=> array(
		'0'			=> 'Gegenstand',
		'1'			=> 'Transaktion',
	),
	'gb_subject'					=> 'Verwendungszweck',
	'gb_members'					=> 'Empfänger',
	'gb_manage_bank_transa'			=> 'Transaktionen verwalten',
	'gb_item_added'					=> 'Gegenstand hinzugefügt',
	'gb_item_payout'				=> 'Gegenstand verkauft',
	'gb_payout_item'				=> 'Gegenstand verkaufen',
	'add_transaction'				=> 'Transaktion hinzufügen',
	'gb_adjustment_text'			=> 'Gildenbank - Gegenstand wurde gekauft',
	'gb_item_sellable'				=> 'Gegenstand verlaufbar',

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
	'gb_payput_button'				=> 'Gegenstand ausbezahlen',
	'gb_ta_head_transaction'		=> 'Transaktion verwalten',
	'gb_ta_head_payout'				=> 'Gegenstand ausbezahlen',
	'gb_ta_head_item'				=> 'Gegenstand verwalten',

	// settings
	'gb_header_global'				=> "Gildenbank Einstellungen",
	'gb_saved'						=> "Die Einstellungen wurden erfolgreich gespeichert",
	'gb_show_money'					=> "Zeige Bankvermögen",
	'gb_show_money_help'			=> "Zeige Bankvermögen (wenn aus: Keine Goldanzeige)",
	'gb_merge_banker'				=> "Alle Banken zusammenfassen",
	'gb_merge_banker_help'			=> "Fasse alle Banken in einer Bank zusammen",
	'gb_show_tooltip'				=> "Zeige Info-Tooltips",
	'gb_show_tooltip_help'			=> "keine Ahnung was da stut ;)",
	'gb_enable_autoadjustment'		=> 'Automatische Korrektur für verkaufte Gegenstände',
	'gb_enable_autoadjustment_help'	=> 'Sollen für jeden verkauften Gegenstand automatische Korrekturen eingetragen werden?',
	'gb_default_event'				=> 'Standardereignis für die automatische Korrektur',
	'gb_default_event_help'			=> 'Falls die automatische Korrektur verwendet werden soll, muss ein Standardereignis gesetzt werden',

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
