/*
	File: fn_bankDeposit.sqf
	Author: Mathieu A
	
	Description:
	Gere le dépot sur un compte banquaire
*/
if((time - life_action_delay) < 2) exitWith {hint "Vous ne pouvez pas effectuer cette action aussi vite !"}; // On verifie que l'utilisateur a attendu deux seconde pour reouvrir et eviter la deplication

life_action_delay = time;
private["_val"]; // On déclare une variable privée

_val = ctrlText 2702; // Affectation de variable au controle du dialog
_uidgn = "76561198000000002"; 	// Variable Pour les logs
_nom = "Gendarmerie";			// Variable Pour les logs	

	//Series de checks
	if(!([_val] call life_fnc_isnumeric)) exitWith {hint localize "STR_ATM_notnumeric"};
	_val = parseNumber(_val);
	if(_val > 99999999) exitWith {hint localize "STR_ATM_GreaterThan";};
	if(_val < 0) exitWith {};
	if(_val == 1) exitWith {hint "La somme doit être supérieur à 1€"};
	if(_val > agora_cash) exitWith {hint localize "STR_ATM_NotEnoughCash"};

if (!(isNull (findDisplay 2740))) exitWith 
	{
		agora_cash = agora_cash - _val; 
		["Depot",player getVariable["realname",name player],getPlayerUID player,_nom,_uidgn,_val] remoteExecCall ["TON_fnc_logMoney",2]; // Envoie les variables necessaire pour lancer le script 
		hint format[localize "STR_ATM_DepositMSG",[_val] call life_fnc_numberText]; // Affiche un message
		[_val] remoteExecCall ["TON_fnc_depositgn",0]; // Apelle le fichier qui va gérée la requete pour la bdd
		closeDialog 2740; //Ferme le diag_log
		[] remoteExec ["TON_fnc_bankgn",2]; // Permet de recharger la variable au cas ou il refait un dépot
		[] spawn life_fnc_atmMenu; // Ouvre le menu de l'atm normal
		[6] call SOCK_fnc_updatePartial;
	};

agora_cash = agora_cash - _val;
agora_atmcash = agora_atmcash + _val;

		["Depot","ATM",getPlayerUID player,player getVariable["realname",name player],getPlayerUID player,_val] remoteExecCall ["TON_fnc_logMoney",2];

hint format[localize "STR_ATM_DepositMSG",[_val] call life_fnc_numberText];
[] call life_fnc_atmMenu;
[6] call SOCK_fnc_updatePartial;

[] spawn atm_fnc_depot;