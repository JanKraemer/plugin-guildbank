<?php
 /*
 * Project:		EQdkp-Plus Guildbank Plugin
 * License:		Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:		2014
 * Date:		$Date$
 * -----------------------------------------------------------------------
 * @author		$Author$
 * @copyright	2006-2014 EQdkp-Plus Developer Team
 * @link		http://eqdkp-plus.com
 * @package		eqdkp-plus
 * @version		$Rev$
 * 
 * $Id$
 */

if (!defined('EQDKP_INC')){
	header('HTTP/1.0 404 Not Found');exit;
}

$lang = array(
	'guildbank'						=> "Gildenbank",
	'guildbank_short_desc'			=> 'Banken des Raids verwalten',
	'guildbank_long_desc'			=> 'Gildenbank ist ein Plugin um Raidbanken zu verwalten.',
	'guildbank_not_installed'		=> 'Gildenbank ist nicht installiert.',

	// Permissions
	'gb_a_perm_auctions'			=> 'Auktionen verwalten',
	'gb_u_perm_auction'				=> 'An Auktionen teilnehmen',
	'gb_perm_shop'					=> 'Gegenstände einkaufen',

	// Main Menu
	'gb_mainmenu_guildbank'			=> "Gildenbank",

	// Admin Menu
	'gb_adminmenu_guildbank'		=> "Gildenbank",

	//guildbank
	'gb_banker'						=> "Bankier",
	'gb_shop'						=> "Itemshop",
	'gb_not_avail'					=> "n.v.",
	'gb_all_bankers'				=> "Alle Banken",
	'gb_total_bankers'				=> "Vermögen aller Banken",
	'gb_mainchar_out'				=> "Hauptcharakter",
	'gb_no_bankchar'				=> 'Keiner',
	'gb_update'						=> 'Letzte Aktivität',
	'gb_tab_transactions'			=> 'Transaktionen',
	'gb_tab_items'					=> 'Gegenstände',
	'gb_tab_auctions'				=> 'Auktionen',
	'gb_title_page'					=> 'Gildenbank ansehen',

	// Shop
	'gb_shop_window'				=> 'Gegenstand einkaufen',
	'gb_shop_icon_title'			=> 'Gegenstand kaufen',
	'gb_shop_buy'					=> 'Kaufen',
	'gb_item_name'					=> 'Gegenstand',
	'gb_item_value'					=> 'Kaufpreis (DKP)',
	'gb_item_date'					=> 'Kaufdatum',
	'gb_dkppool'					=> 'MultiDKP-Pool',
	'gb_shop'						=> 'Shop',
	'gb_shop_error_nodkp'			=> 'Die vorhandenen DKP reichen nicht zum Kauf dieses Gegenstandes',
	'gb_shop_error_noitem'			=> 'Es ist kein Gegenstand zum Kauf mehr vorhanden',
	'gb_shop_buy_subject'			=> 'Gegenstand eingekauft',
	'gb_shop_buy_successmsg'		=> 'Der Gegenstand wurde zum einkaufen vorgemerkt. Die Transaktion wird nach der Bestätigung durch einen Admin vorgenommen und deinem Konto gutgeschrieben.',
	'gb_confirm_shop_ta_head'		=> 'Gildenbank Gegenstandseinkäufe',
	'gb_confirm_shop_ta_button'		=> 'Einkauf bestätigen',
	'gb_decline_shop_ta_button'		=> 'Einkauf ablehnen',
	'gb_confirm_msg_success'		=> 'Die Transaktion wurde erfolgreich durchgeführt',
	'gb_confirm_msg_delete'			=> 'Die Transaktion wurde erfolgreich abgelehnt',
	'gb_notify_shopta_header'		=> 'Gegenstandseinkäufe freigeben',
	'gb_notify_shopta_confirm_req1'	=> 'Ein Einkauf wartet auf Freigabe',
	'gb_notify_shopta_confirm_req2'	=> "%s Einkäufe warten auf Freigabe",

	// manage_auction
	'gb_manage_auctions'			=> 'Auktionen verwalten',
	'gb_auction_management'			=> 'Auktionsverwaltung',
	'gb_auction_head_add'			=> 'Auktion hinzufügen',
	'gb_auction_head_edit'			=> 'Auktion bearbeiten',
	'gb_footer_auction'				=> "... %1\$d Auktion(en) gefunden / %2\$d pro Seite",
	'gb_add_auction'				=> 'Auktion erstellen',
	'gb_delete_auctions'			=> 'Ausgewählte Gegenstände löschen',
	'gb_add_auction_title'			=> 'Auktion hinzufügen',
	'gb_edit_auction_title'			=> 'Auktion bearbeiten',
	'gb_auction_item'				=> 'Gegenstand',
	'gb_auction_item_help'			=> 'Ein oder mehrere Gegenstände zum versteigern. Bei Mehrfachauswahl werden mehrere Auktionen erstellt',
	'gb_auction_startdate'			=> 'Startzeitpunkt',
	'gb_auction_duration'			=> 'Auktionsdauer',
	'gb_auction_duration_help'		=> 'Die Auktionsdauer in Stunden',
	'gb_auction_startvalue'			=> 'Startgebotswert',
	'gb_auction_bidsteps'			=> 'Gebotsschrittweite',
	'gb_auction_bidsteps_help'		=> 'Bieter können in diesen Schrittweiten auf den Gegenstand bieten',
	'gb_auction_raidatt'			=> 'Raidteilnamen für Gebot',
	'gb_auction_raidatt_help'		=> 'Anzahl der Raidteilnamen in dem die betreffenden Gegenstände gefallen sind. Bei 0 kann jeder auf den Gegenstand bieten.',
	'gb_confirm_delete_auctions'	=> "Bist Du sicher, dass Du diese Auktion(en) %s löschen willst?",
	'gb_auction_multidkppool'		=> 'Multidkp Pool',
	'gb_auction_multidkppool_help'	=> 'Gib einen Multidkp Pool an, aus dem die Punkte für die Gebote verwendet werden sollen',

	// auction shop
	'gb_auction_icon_title'			=> 'Gebote abgeben',
	'gb_auction_window'				=> 'Auktion',
	'gb_auction_title'				=> 'Auktion & Gebote',
	'gb_button_bid'					=> 'Bieten',
	'gb_error_noidnotloggedin'		=> 'ACHTUNG: Um die Auktionen verwenden zu können, musst du sowohl eingeloggt als auch eine gültige AUktionsID verwenden. Versuche es noch einmal.',
	'gb_auction_avail_dkp'			=> 'Verfügbare Punkte',
	'gb_auction_timeleft'			=> 'Verbleibende Auktionszeit',
	'gb_auction_bid_info'			=> 'Gebot abgeben',
	'gb_bids_footcount'				=> "... %1\$d Gebot(e) / %2\$d pro Seite",

	// manage_banker
	'gb_manage_bankers'				=> 'Gilden-Bankiers verwalten',
	'gb_confirm_delete_bankers'		=> "Sollen die Bankiers %s gelöscht werden?",
	'gb_banker_mainchar'			=> 'Bank-Charakter',
	'gb_money'						=> 'Guthaben',

	// manage transactions
	'gb_manage_bank_items_title'	=> "Gegegenstände des Bankiers '%s' bearbeiten",
	'gb_manage_bank_items'			=> "Bankgegegenstände bearbeiten",
	'gb_mode'						=> 'Modus',
	'gb_a_mode'					=> array(
		'0'			=> 'Gegenstand',
		'1'			=> 'Transaktion',
	),
	'gb_subject'					=> 'Verwendungszweck',
	'gb_members'					=> 'Empfänger',
	'gb_manage_bank_transa'			=> 'Transaktionen verwalten',
	'gb_title_transaction'			=> 'Transaktionensverwaltung',
	'gb_title_item'					=> 'Gegenstandsverwaltung',
	'gb_item_added'					=> 'Gegenstand hinzugefügt',
	'gb_item_payout'				=> 'Gegenstand verkauft',
	'gb_payout_item'				=> 'Gegenstand verkaufen',
	'add_transaction'				=> 'Transaktion hinzufügen',
	'gb_adjustment_text'			=> 'Gildenbank - Gegenstand wurde gekauft',
	'gb_item_sellable'				=> 'Gegenstand verkaufbar',
	'gb_itemvalue'					=> 'Gegenstandswert',

	// add/edit banker
	'gb_manage_banker'				=> 'Banker verwalten',
	'gb_add_item_title'				=> 'Gegenstand zum Bankkonto hinzufügen',
	'gb_edit_item_title'			=> 'Gegenstand bearbeiten',
	'gb_item_name'					=> "Gegenstand",
	'gb_rarity'						=> 'Gegenstandslevel',
	'gb_type'						=> "Gegenstandsart",
	'gb_dkp'						=> "DKP",
	'gb_amount'						=> "Menge",
	'gb_additem_button'				=> 'Gegenstand speichern',
	'gb_payout_button'				=> 'Gegenstand ausbezahlen',
	'gb_addtrans_button'			=> 'Transaktion speichern',
	'gb_ta_head_transaction'		=> 'Transaktion verwalten',
	'gb_ta_head_payout'				=> 'Gegenstand ausbezahlen',
	'gb_ta_head_item'				=> 'Gegenstand verwalten',

	// settings
	'gb_header_global'				=> "Gildenbank Einstellungen",
	'gb_breadcrumb_settings'		=> "Gildenbank: Einstellungen",
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

	// default currency
	'gb_currency'					=> array(
		'platin'	=> 'Platin',
		'platin_s'	=> 'P',
		'gold'		=> 'Gold',
		'gold_s'	=> 'G',
		'silver'	=> 'Silber',
		'silver_s'	=> 'S',
		'copper'	=> 'Kupfer',
		'copper_s'	=> 'K',
		'diamond'	=> 'Diamant',
		'diamond_s'	=> 'D',
	),

	// credits
	'gb_credits'					=> "Gildenbank %s",
);
?>
