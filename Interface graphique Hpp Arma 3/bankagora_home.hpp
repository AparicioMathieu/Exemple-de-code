class Life_atm_management_new_home {
	idd = 27001;
	name= "life_atm_menu_new";
	movingEnable = false;
	enableSimulation = true;
	onLoad = "[] spawn atm_fnc_accueil;";
	
	 class controlsBackground {
        class backgroundScreen: Life_RscPicture {
            idc = 45091;
            text = "\Agorapolis_data\ATM\image_back.paa";
           		x = -0.75;
      			y = -0.45;
      			w = 2.50;
      			h = 1.86;
        };
    };
	
	class controls {

		class backgroundScreen: Life_RscPicture {
            idc = 45091;
            text = "\Agorapolis_data\ATM\logov2.paa";
           	x = 0.14;
			y = 0.22;
			w = 0.10;
      		h = 0.15;
        };

		class button_clignotant : Life_RscButtonInvisible { // mettre image carte 
			idc = 45093;
			onButtonClick = "closeDialog 0;";			
			x = 0.58;
      		y = -0.25;
      		w = 0.35;
      		h = 0.26;	
        
		};

			class CashTitle : Life_RscStructuredText
		{
			idc = 45094;
			text = "Votre solde est de : ";
			
			x = -0.40;
      		y = 0.41;
      		w = 0.55;
      		h = 0.15;
		};

		class CashTitleresult : Life_RscStructuredText
		{
			idc = 2701;
			text = "";
			
			x = -0.06;
      		y = 0.41;
      		w = 0.55;
      		h = 0.15;
		};
	
		class Title : Life_RscTitle {
			colorBackground[] = {0.984,0.878,0,0.7};
			idc = -1;
			text = "Opération disponible : ";
			style = 2;
				x = -0.41;
      			y = 0.49;
      			w = 0.65;
      			h = 0.08;
		};

		class Retrait : Life_RscTitle {
			
			idc = -1;
			text = "Effectuer un retrait  ";
				x = -0.41;
      			y = 0.61;
      			w = 0.65;
      			h = 0.05;
		};

		class buttonretrait : Life_RscButtonInvisible {  
			idc = 45093;
			onButtonClick = "closeDialog 0; createDialog ""Life_atm_management_new_retrait"";";		
			x = -0.54;
      		y = 0.61;
      		w = 0.10;
      		h = 0.05;	
        
		};

		class Depot : Life_RscTitle {
			
			idc = 45992;
			text = "Effectuer un dépot  ";
			x = 0.02;
      		y = 0.61;
      		w = 0.65;
    		h = 0.05;
		};

		class button_depot : Life_RscButtonInvisible { 
			idc = 45993;
			onButtonClick = "closeDialog 0; createDialog ""Life_atm_management_new_depot"";";			
			x = 0.26;
      		y = 0.61;
      		w = 0.10;
      		h = 0.05;	
        
		};

			class Transfert : Life_RscTitle {
			
			idc = -1;
			text = "Transfert ";
			x = -0.41;
    		y = 0.73;
  			w = 0.65;
 			h = 0.05;
		};

	class buttontransfert : Life_RscButtonInvisible { 
			idc = 45093;
			onButtonClick = "closeDialog 0; createDialog ""Life_atm_management_new_transfert"";";			
			x = -0.54;
      		y = 0.73;
      		w = 0.10;
      		h = 0.05;	
        
		};

		class Restition : Life_RscTitle {
			
			idc = -1;
			text = " Restituer la carte  ";
			x = 0.02;
      		y = 0.73;
    		w = 0.65;
  			h = 0.05;
		};

		class buttonrestitution : Life_RscButtonInvisible { 
			idc = 45093;
			onButtonClick = "closeDialog 0;";			
			x = 0.26;
      		y = 0.73;
      		w = 0.10;
      		h = 0.05;	
		};
	};
};