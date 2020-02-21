#include "..\..\macro.h"
/*
	File: fn_bankTransfer.sqf
	Author: Aparicio M
	
	Description:
	Gere le transfert d'argent de compte en compte 
*/
if((time - life_action_delay) < 4) exitWith {hint "Vous ne pouvez pas effectuer cette action aussi vite !"};
life_action_delay = time;

private["_val","_unit","_tax"];

_val = ctrlText 2702;
_unit = call compile format["%1",(lbData[2703,(lbCurSel 2703)])];

if(isNull _unit) exitWith {};
if((lbCurSel 2703) == -1) exitWith {hint localize "STR_ATM_NoneSelected"};
if(isNil "_unit") exitWith {hint localize "STR_ATM_DoesntExist"};
if(vehicle _unit != _unit) exitWith {hint "La personne est dans un véhicule, veuillez faire le transfert plus tard !";};
if(!([_val] call life_fnc_isnumeric)) exitWith {hint localize "STR_ATM_notnumeric"};
_val = parseNumber(_val);
if(_val > 99999999) exitWith {hint localize "STR_ATM_TransferMax";};
if(_val < 0) exitwith {};
if(_val == 1) exitWith {hint "La somme doit être supérieur à 1€"};
if(_val > agora_atmcash) exitWith {hint localize "STR_ATM_NotEnough"};
_tax = [_val] call life_fnc_taxRate;
if((_val + _tax) > agora_atmcash) exitWith {hint format[localize "STR_ATM_SentMoneyFail",_val,_tax]};

	

[_val,_unit,_tax] spawn {
	private ["_val","_unit","_tax","_action"];
	_val = _this select 0;
	_unit = _this select 1;
	_tax = _this select 2;
	_uidgn = "76561198000000002"; 	// Pour les logs
	_nom = "Gendarmerie";			// Pour les logs	

	_action = [
		format["Êtes-vous sûr de vouloir effectuer un transfert d'un montant de <t color='#8cff9b'>%1 €</t> (<t color='#7de389'>%3 €</t> de taxe supplémentaire) à %2 ?",[_val] call life_fnc_numberText,_unit getVariable ["realname",name _unit],[_tax] call life_fnc_numberText],
		"Confirmation de Transfert",
		localize "STR_Global_Yes",
		localize "STR_Global_No"
	] call BIS_fnc_guiMessage;

	if(_action) then {
		
		if (!(isNull (findDisplay 2740))) then
		{
			["Transfert",_nom,_uidgn,player getVariable["realname",name player],getPlayerUID player,_val] remoteExecCall ["TON_fnc_logMoney",RSERV];
			[_val,profileName] remoteExecCall ["life_fnc_clientWireTransfer",_unit];
			hint format[localize "STR_ATM_SentMoneySuccess",[_val] call life_fnc_numberText,_unit getVariable["realname",name _unit],[_tax] call life_fnc_numberText];
			[_tax] remoteExecCall ["TON_fnc_taxeTransfert", RSERV];
			[_val] remoteExecCall ["TON_fnc_withdrawgn",0];
			closeDialog 2740;
		
			[] remoteExec ["TON_fnc_bankgn",2]; // Recharge la variable
			[] spawn life_fnc_atmMenu; 
		} else {
			hint "Vous avez annulé le transfert.";
		};
		
		agora_atmcash = agora_atmcash - (_val + _tax);

		["Transfert",player getVariable["realname",name player],getPlayerUID player,_unit getVariable["realname",name _unit],getPlayerUID _unit,_val] remoteExecCall ["TON_fnc_logMoney",RSERV];

		[_val,profileName] remoteExecCall ["life_fnc_clientWireTransfer",_unit];
		[] call life_fnc_atmMenu;
		hint format[localize "STR_ATM_SentMoneySuccess",[_val] call life_fnc_numberText,_unit getVariable["realname",name _unit],[_tax] call life_fnc_numberText];
		[_tax] remoteExecCall ["TON_fnc_taxeTransfert", RSERV];
		[1] call SOCK_fnc_updatePartial;
	} else {
		hint "Vous avez annulé le transfert.";
	};
};

[] spawn atm_fnc_transfert;