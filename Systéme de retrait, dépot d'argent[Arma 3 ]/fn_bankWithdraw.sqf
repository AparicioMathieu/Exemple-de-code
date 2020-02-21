/*
	File: fn_bankWithdraw.sqf
	Author: Aparicio 
	
	Description:
	Retrait.
*/

if((time - life_action_delay) < 2) exitWith {hint "Vous ne pouvez pas effectuer cette action aussi vite !"};
life_action_delay = time;
private["_val"];
_val = ctrlText 2702;

_uidgn = "76561198000000002"; 	// Pour les logs
_nom = "Gendarmerie";			// Pour les logs	

if(!([_val] call life_fnc_isnumeric)) exitWith {hint localize "STR_ATM_notnumeric"};
_val = parseNumber(_val);
if(_val > 99999999) exitWith {hint localize "STR_ATM_WithdrawMax";};
if(_val < 0) exitwith {};
if(_val > agora_atmcash) exitWith {hint localize "STR_ATM_NotEnoughFunds"};
if(_val < 100 && agora_atmcash > 20000000) exitWith {hint localize "STR_ATM_WithdrawMin"}; //Temp fix for something.

if (!(isNull (findDisplay 2740))) exitWith { // Block concernant le withdraw sur le compte gendarme.

		agora_cash = agora_cash + _val;
		["Retrait",player getVariable["realname",name player],getPlayerUID player,_nom,_uidgn,_val] remoteExecCall ["TON_fnc_logMoney",2];
		hint format [localize "STR_ATM_WithdrawSuccess",[_val] call life_fnc_numberText];
		[_val] remoteExecCall ["TON_fnc_withdrawgn",0]; // Apelle le fichier qui va gérée la requete pour la bdd
		closeDialog 2740; //Ferme le diag_log
		[] remoteExec ["TON_fnc_bankgn",2]; // Permet de recharger la variable au cas ou il refait un dépot
		[] spawn life_fnc_atmMenu; // Ouvre le menu de l'atm normal
		[6] call SOCK_fnc_updatePartial;
};

agora_cash = agora_cash + _val;
agora_atmcash = agora_atmcash - _val;

		["Retrait","ATM",getPlayerUID player,player getVariable["realname",name player],getPlayerUID player,_val] remoteExecCall ["TON_fnc_logMoney",2];

hint format [localize "STR_ATM_WithdrawSuccess",[_val] call life_fnc_numberText];
[] call life_fnc_atmMenu;
[6] call SOCK_fnc_updatePartial;

[] spawn atm_fnc_retrait;