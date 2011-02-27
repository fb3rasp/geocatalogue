<?php
/**
 * @author Rainer Spittel (rainer at silverstripe dot com)
 * @package geonetwork
 * @subpackage
 */

/**
 * CustomPlaces stores the customised regions for the catalogue selection.
 */
class NewZealandPlaces extends Object {

	/**
	 * Predefined places and geospatial bounding box: New Zealand Regions
	 * @var array
	 */
	
	static $CoordinatesByName =array(
		"Overall area for catalogue of New Zealand's spatial information" => "-141.0000;158.0000;-90.0000;-7.000",
			'New Zealand Mainland, Chatham Islands Territory, and Territorial Sea (out to 12 nautical miles)' => '166.0000;-175.5000;-47.8333;-34.0000',
				//"Region, including Chatham Islands and Territorial Sea out to 12 nautical miles" 
				"Northland Region" => "172.3764;175.0204;-36.5602;-34.1778",
				"Auckland Region" => "173.8871;175.944;-37.3613;-35.6814",
				"Waikato Region" => "174.2849;176.5487;-39.3269;-36.245",
				"Bay of Plenty Region" => "175.7837;178.2026;-39.0206;-36.8332",
				"Gisborne Region" => "177.055;178.941;-39.045;-37.3015",
				"Hawke's Bay Region" => "176.0104;178.3658;-40.5173;-38.5399",
				"Taranaki Region" => "173.4885;175.0069;-40.0806;-38.693",
				"Manawatu-Wanganui Region" => "174.6602;176.91;-40.8534;-38.4368",
				"Wellington Region" => "174.3715;176.6173;-41.8296;-40.5888",
				"West Coast Region" => "167.8075;172.6947;-44.5917;-40.5294",
				"Canterbury Region" => "169.4923;174.3286;-45.1029;-41.8616",
				"Otago Region" => "167.9462;171.4344;-46.8858;-43.9029",
				"Southland Region" => "165.9056;169.51;-47.7811;-44.0497",
				"Tasman Region" => "172.0054;173.3695;-42.3064;-40.2946",
				"Nelson Region" => "173.1751;173.6017;-41.3934;-40.8044",
				"Marlborough Region" => "172.7169;174.6432;-42.4878;-40.4541",
				"Chatham Islands Territory" => "177.358;-175.5;-44.6085;-43.3465",
				// "Territorial Local Authority Area" 
					"Far North District" => "172.6298;174.3498;-35.675;-34.3854",
					"Whangarei District" => "173.7467;174.788;-36.093;-35.2953",
					"Kaipara District" => "173.4767;174.6223;-36.4001;-35.5863",
					"Rodney District" => "174.1566;174.9066;-36.8948;-36.1136",
					"North Shore City" => "174.6315;174.814;-36.8354;-36.6597",
					"Waitakere City" => "174.4408;174.6961;-37.0529;-36.7728",
					"Auckland City" => "174.6384;175.5716;-36.9628;-35.8883",
					"Manukau City" => "174.618;175.2888;-37.0714;-36.8391",
					"Papakura District" => "174.8977;175.042;-37.1396;-37.0014",
					"Franklin District" => "174.5348;175.3359;-37.5901;-36.9958",
					"Thames-Coromandel District" => "175.3241;176.1206;-37.3049;-36.4042",
					"Hauraki District" => "175.3023;175.9519;-37.5751;-37.1594",
					"Waikato District" => "174.7406;175.5521;-38.0164;-37.1786",
					"Matamata-Piako District" => "175.3718;175.9743;-37.9579;-37.4097",
					"Hamilton City" => "175.1834;175.337;-37.8483;-37.7084",
					"Waipa District" => "175.0524;175.6686;-38.2083;-37.7666",
					"Otorohanga District" => "174.7729;175.7031;-38.5091;-37.9483",
					"South Waikato District" => "175.6146;176.1597;-38.4444;-37.8876",
					"Waitomo District" => "174.5996;175.6384;-38.7783;-38.0701",
					"Taupo District" => "175.5028;176.7197;-39.307;-38.2745",
					"Western Bay of Plenty District" => "175.801;176.6114;-38.0327;-37.3556",
					"Tauranga City" => "176.0687;176.4156;-37.7717;-37.6169",
					"Rotorua District" => "175.9738;176.6402;-38.5785;-37.9275",
					"Whakatane District" => "176.4443;177.2675;-38.8623;-37.8097",
					"Kawerau District" => "176.6394;176.7378;-38.1158;-38.0569",
					"Opotiki District" => "177.077;178.1705;-38.5375;-37.532",
					"Gisborne District" => "177.066;178.674;-39.002;-37.5164",
					"Wairoa District" => "176.6814;178.0156;-39.3476;-38.5512",
					"Hastings District" => "176.1111;177.1301;-39.9155;-38.8436",
					"Napier City" => "176.8025;176.9295;-39.5729;-39.3866",
					"Central Hawke's Bay District" => "176.0801;176.9986;-40.445;-39.6624",
					"New Plymouth District" => "173.8151;174.8764;-39.298;-38.7028",
					"Stratford District" => "174.0578;175.0783;-39.4163;-38.8852",
					"South Taranaki District" => "173.7503;175.0011;-39.8793;-39.1604",
					"Ruapehu District" => "174.7802;176.0404;-39.6353;-38.5362",
					"Wanganui District" => "174.7506;175.5283;-40.0465;-39.2186",
					"Rangitikei District" => "175.0724;176.3782;-40.2993;-39.1296",
					"Manawatu District" => "175.2062;176.1515;-40.4462;-39.7909",
					"Palmerston North City" => "175.4917;175.7993;-40.5315;-40.2731",
					"Tararua District" => "175.4486;176.6503;-40.8021;-39.9806",
					"Horowhenua District" => "175.1262;175.6352;-40.7712;-40.3787",
					"Kapiti Coast District" => "174.8635;175.4348;-41.0151;-40.6947",
					"Porirua City" => "174.7685;174.9974;-41.1647;-41.0029",
					"Upper Hutt City" => "174.9576;175.3144;-41.2282;-40.946",
					"Lower Hutt City" => "174.8415;175.0926;-41.4379;-41.1309",
					"Wellington City" => "174.6097;174.9014;-41.3639;-41.1419",
					"Masterton District" => "175.433;176.2936;-41.2091;-40.6684",
					"Carterton District" => "175.2637;175.9997;-41.3739;-40.7324",
					"South Wairarapa District" => "174.9456;175.8217;-41.6196;-40.9118",
					"Tasman District" => "172.0054;173.3695;-42.3064;-40.2946",
					"Nelson City" => "173.1757;173.6017;-41.3934;-41.0511",
					"Marlborough District" => "172.7169;174.4896;-42.4878;-40.6458",
					"Kaikoura District" => "173.1794;174.074;-42.5664;-41.9049",
					"Buller District" => "171.3151;172.6941;-42.5276;-40.7655",
					"Grey District" => "171.1232;172.2013;-42.7683;-42.0484",
					"Westland District" => "168.033;171.8876;-44.5864;-42.4743",
					"Hurunui District" => "171.8731;173.5067;-43.2462;-42.083",
					"Waimakariri District" => "171.9242;172.7386;-43.4625;-42.9519",
					"Christchurch City" => "172.3611;173.1305;-43.9016;-43.3885",
					"Selwyn District" => "171.0894;172.6331;-43.9061;-42.7307",
					"Ashburton District" => "170.5686;172.2062;-44.1963;-43.0852",
					"Timaru District" => "170.5404;171.5247;-44.5051;-43.4493",
					"Mackenzie District" => "169.792;171.2364;-44.4884;-43.3931",
					"Waimate District" => "170.1684;171.2196;-44.9413;-44.3044",
					"Waitaki District" => "169.462;171.1794;-45.5854;-43.7778",
					"Central Otago District" => "168.7392;170.4686;-45.8366;-44.4251",
					"Queenstown-Lakes District" => "168.0767;169.7241;-45.3973;-43.9029",
					"Dunedin City" => "169.7164;170.7752;-46.0638;-45.2161",
					"Clutha District" => "168.9277;170.2324;-46.6613;-45.4345",
					"Southland District" => "166.262;169.4292;-47.3594;-44.1754",
					"Gore District" => "168.6909;169.2263;-46.3041;-45.7818",
					"Invercargill City" => "168.1749;168.5648;-46.6585;-46.3155",
					"Chatham Islands Territory" => "177.358;-175.5;-44.6085;-43.3465",
				// "Topo50 map series (level 3)
				// "Topo250 map series"
				/*  
					"Alexandra" => ";;;",
                    "Auckland" => ";;;",
                    "Chatham Islands" => ";;;",
                    "Christchurch" => ";;;",
                    "Dannevirke" => ";;;",
                    "Dargaville" => ";;;",
                    "Dunedin" => ";;;",
                    "Dusky Sound" => ";;;",
                    "East Cape" => ";;;",
                    "Greymouth" => ";;;",
                    "Gisborne" => ";;;",
                    "Haast" => ";;;",
                    "Invercargill" => ";;;",
                    "Kaikohe" => ";;;",
                    "Kaikoura" => ";;;",
                    "Martins Bay" => ";;;",
                    "Murchison" => ";;;",
                    "Napier" => ";;;",
                    "Nelson" => ";;;",
                    "New Plymouth" => ";;;",
                    "North Cape (Otou)" => ";;;",
                    "Owaka" => ";;;",
                    "Palmerston North" => ";;;",
                    "Takaka" => ";;;",
                    "Tauranga" => ";;;",
                    "Taumarunui" => ";;;",
                    "Te Anau" => ";;;",
                    "Timaru" => ";;;",
                    "Tuatapere" => ";;;",
                    "Warkworth" => ";;;",
                    "Wellington" => ";;;",
				*/
			"New Zealand's offshore islands" =>	"166.4833;-177.8333;-55.9500;-29.2167",
				"Auckland Island" => "165.8333;166.4167;-55.9500;-50.4167",
                "Antipodes Island" => "178.7167;178.8333;-49.7333;-49.6333",
                "Bounty Islands"  => "179.0000;179.0833;-47.7833;-46.9667",
                "Campbell Island" => "168.9666;169.2833;-52.6333;-52.4500",
                "Raoul Island" => "-177.9833;-177.8333;-29.3166;-29.2166",
                "Snares Island" => "166.4833;166.6333;-48.0500;-47.9833",
			"New Zealand's Maritime zones out to continental shelf boundary" => "158.0000;-166.0000;-58.0000;-23.0000",
            "New Zealand Dependencies in the South West Pacific" => "165.8333;-177.8333;-29.2166;-5.9500",
				"Cook Islands" => "-166.2000;-157.0000;-22.2166;-8.6333",
                "Niue" => "-169.9666;-169.7666;-19.1666;-18.8666",
                "Tokelau Islands" => "-172.5667;-171.1000;-8.4833;-9.4833",
			"Antarctic Ross Dependency" => "160.0000;-150.0000;-60.0000;-90.0000",


	);
	
/*	
	W: -141
	E: 160
	S: -90
	N: -7
	
	W: -150
	E: 160
	S: -90
	N: -60
	
	"New Zealand's offshore islands (BBox: 166˚ 29` E - 177˚ 50` W 29˚ 13` S - 55˚57` S)"
	e: 166.48333 {166˚ 29` E}
	w: 177.83333 {177˚ 50` E}
	n: -29.21667 {29˚ 13` S}
	s: -55.95 {55˚57` S}
	

*/	
	
	// default: New Zealand charting area: 
	// 		"158;-141;-7;-90" => "New Zealand charting area"
	// other areas:
	// 	"170;180;-52.57806;-32.41472" => "New Zealand"
	static $NZPlaces = array (	
		"-141;158;-90;-7" => "New Zealand Charting Area",		// (Level 1) this region passes the date-line
		"166.0000;-175.5000;-47.8333;-34.0000" => "New Zealand Land", //(level 2 - has sublevels)
		"166.4833;-177.8333;-55.9500;-29.2167" => "New Zealand's offshore islands", //(level 2  -has sublevels)
		"158.0000;-166.0000;-58.0000;-23.0000" => "New Zealand's Maritime zones out to continental shelf boundary", //(level 2 - NO sublevels)
		"165.8333;-177.8333;-29.2166;-5.9500" => "New Zealand Dependencies in the South West Pacific", //(level2 -  has sublevels)
		"160.0000;-150.0000;-60.0000;-90.0000" => "Antarctic Ross Dependency", //(level 2 - NO sublevels)
	);
	
	/**
	 * Predefined places and geospatial bounding box: New Zealand Regions
	 * @var array
	 */
	static $NZRegions = array (	
		";;;" => "(anywhere)",
		"172.3764;175.0204;-36.5602;-34.1778" =>"Northland Region",
		"173.8871;175.944;-37.3613;-35.6814" =>"Auckland Region",
		"174.2849;176.5487;-39.3269;-36.245" =>"Waikato Region",
		"175.7837;178.2026;-39.0206;-36.8332" =>"Bay of Plenty Region",
		"177.055;178.941;-39.045;-37.3015" =>"Gisborne Region",
		"176.0104;178.3658;-40.5173;-38.5399" =>"Hawke's Bay Region",
		"173.4885;175.0069;-40.0806;-38.693" =>"Taranaki Region",
		"174.6602;176.91;-40.8534;-38.4368" =>"Manawatu-Wanganui Region",
		"174.3715;176.6173;-41.8296;-40.5888" =>"Wellington Region",
		"167.8075;172.6947;-44.5917;-40.5294" =>"West Coast Region",
		"169.4923;174.3286;-45.1029;-41.8616" =>"Canterbury Region",
		"167.9462;171.4344;-46.8858;-43.9029" =>"Otago Region",
		"165.9056;169.51;-47.7811;-44.0497" =>"Southland Region",
		"172.0054;173.3695;-42.3064;-40.2946" =>"Tasman Region",
		"173.1751;173.6017;-41.3934;-40.8044" =>"Nelson Region",
		"172.7169;174.6432;-42.4878;-40.4541" =>"Marlborough Region",
		"177.358;-175.5;-44.6085;-43.3465" =>"Chatham Islands Territory",
	);	
	
	/**
	 * Predefined places and geospatial bounding box: New Zealand TA
	 * @var array
	 */
	static $NZTA = array(
		";;;" => "(anywhere)",
		"172.6298;174.3498;-35.675;-34.3854" =>"Far North District",
		"173.7467;174.788;-36.093;-35.2953" =>"Whangarei District",
		"173.4767;174.6223;-36.4001;-35.5863" =>"Kaipara District",
		"174.1566;174.9066;-36.8948;-36.1136" =>"Rodney District",
		"174.6315;174.814;-36.8354;-36.6597" =>"North Shore City",
		"174.4408;174.6961;-37.0529;-36.7728" =>"Waitakere City",
		"174.6384;175.5716;-36.9628;-35.8883" =>"Auckland City",
		"174.618;175.2888;-37.0714;-36.8391" =>"Manukau City",
		"174.8977;175.042;-37.1396;-37.0014" =>"Papakura District",
		"174.5348;175.3359;-37.5901;-36.9958" =>"Franklin District",
		"175.3241;176.1206;-37.3049;-36.4042" =>"Thames-Coromandel District",
		"175.3023;175.9519;-37.5751;-37.1594" =>"Hauraki District",
		"174.7406;175.5521;-38.0164;-37.1786" =>"Waikato District",
		"175.3718;175.9743;-37.9579;-37.4097" =>"Matamata-Piako District",
		"175.1834;175.337;-37.8483;-37.7084" =>"Hamilton City",
		"175.0524;175.6686;-38.2083;-37.7666" =>"Waipa District",
		"174.7729;175.7031;-38.5091;-37.9483" =>"Otorohanga District",
		"175.6146;176.1597;-38.4444;-37.8876" =>"South Waikato District",
		"174.5996;175.6384;-38.7783;-38.0701" =>"Waitomo District",
		"175.5028;176.7197;-39.307;-38.2745" =>"Taupo District",
		"175.801;176.6114;-38.0327;-37.3556" =>"Western Bay of Plenty District",
		"176.0687;176.4156;-37.7717;-37.6169" =>"Tauranga City",
		"175.9738;176.6402;-38.5785;-37.9275" =>"Rotorua District",
		"176.4443;177.2675;-38.8623;-37.8097" =>"Whakatane District",
		"176.6394;176.7378;-38.1158;-38.0569" =>"Kawerau District",
		"177.077;178.1705;-38.5375;-37.532" =>"Opotiki District",
		"177.066;178.674;-39.002;-37.5164" =>"Gisborne District",
		"176.6814;178.0156;-39.3476;-38.5512" =>"Wairoa District",
		"176.1111;177.1301;-39.9155;-38.8436" =>"Hastings District",
		"176.8025;176.9295;-39.5729;-39.3866" =>"Napier City",
		"176.0801;176.9986;-40.445;-39.6624" =>"Central Hawke's Bay District",
		"173.8151;174.8764;-39.298;-38.7028" =>"New Plymouth District",
		"174.0578;175.0783;-39.4163;-38.8852" =>"Stratford District",
		"173.7503;175.0011;-39.8793;-39.1604" =>"South Taranaki District",
		"174.7802;176.0404;-39.6353;-38.5362" =>"Ruapehu District",
		"174.7506;175.5283;-40.0465;-39.2186" =>"Wanganui District",
		"175.0724;176.3782;-40.2993;-39.1296" =>"Rangitikei District",
		"175.2062;176.1515;-40.4462;-39.7909" =>"Manawatu District",
		"175.4917;175.7993;-40.5315;-40.2731" =>"Palmerston North City",
		"175.4486;176.6503;-40.8021;-39.9806" =>"Tararua District",
		"175.1262;175.6352;-40.7712;-40.3787" =>"Horowhenua District",
		"174.8635;175.4348;-41.0151;-40.6947" =>"Kapiti Coast District",
		"174.7685;174.9974;-41.1647;-41.0029" =>"Porirua City",
		"174.9576;175.3144;-41.2282;-40.946" =>"Upper Hutt City",
		"174.8415;175.0926;-41.4379;-41.1309" =>"Lower Hutt City",
		"174.6097;174.9014;-41.3639;-41.1419" =>"Wellington City",
		"175.433;176.2936;-41.2091;-40.6684" =>"Masterton District",
		"175.2637;175.9997;-41.3739;-40.7324" =>"Carterton District",
		"174.9456;175.8217;-41.6196;-40.9118" =>"South Wairarapa District",
		"172.0054;173.3695;-42.3064;-40.2946" =>"Tasman District",
		"173.1757;173.6017;-41.3934;-41.0511" =>"Nelson City",
		"172.7169;174.4896;-42.4878;-40.6458" =>"Marlborough District",
		"173.1794;174.074;-42.5664;-41.9049" =>"Kaikoura District",
		"171.3151;172.6941;-42.5276;-40.7655" =>"Buller District",
		"171.1232;172.2013;-42.7683;-42.0484" =>"Grey District",
		"168.033;171.8876;-44.5864;-42.4743" =>"Westland District",
		"171.8731;173.5067;-43.2462;-42.083" =>"Hurunui District",
		"171.9242;172.7386;-43.4625;-42.9519" =>"Waimakariri District",
		"172.3611;173.1305;-43.9016;-43.3885" =>"Christchurch City",
		"171.0894;172.6331;-43.9061;-42.7307" =>"Selwyn District",
		"170.5686;172.2062;-44.1963;-43.0852" =>"Ashburton District",
		"170.5404;171.5247;-44.5051;-43.4493" =>"Timaru District",
		"169.792;171.2364;-44.4884;-43.3931" =>"Mackenzie District",
		"170.1684;171.2196;-44.9413;-44.3044" =>"Waimate District",
		"169.462;171.1794;-45.5854;-43.7778" =>"Waitaki District",
		"168.7392;170.4686;-45.8366;-44.4251" =>"Central Otago District",
		"168.0767;169.7241;-45.3973;-43.9029" =>"Queenstown-Lakes District",
		"169.7164;170.7752;-46.0638;-45.2161" =>"Dunedin City",
		"168.9277;170.2324;-46.6613;-45.4345" =>"Clutha District",
		"166.262;169.4292;-47.3594;-44.1754" =>"Southland District",
		"168.6909;169.2263;-46.3041;-45.7818" =>"Gore District",
		"168.1749;168.5648;-46.6585;-46.3155" =>"Invercargill City",
		"177.358;-175.5;-44.6085;-43.3465" =>"Chatham Islands Territory",
	);
	
	static $NZTLA  = array( 
		'(anywhere)' => array(
			";;;" => "(anywhere)",
			),
		'Northland Region'=> array(
			";;;" => "(anywhere)",
			"172.6298;174.3498;-35.675;-34.3854" =>"Far North District",
			"173.7467;174.788;-36.093;-35.2953" =>"Whangarei District",
			"173.4767;174.6223;-36.4001;-35.5863" =>"Kaipara District",
			) ,
		'Auckland Region' => array(	
			";;;" => "(anywhere)",
			"174.1566;174.9066;-36.8948;-36.1136" =>"Rodney District",
			"174.6315;174.814;-36.8354;-36.6597" =>"North Shore City",
			"174.4408;174.6961;-37.0529;-36.7728" =>"Waitakere City",
			"174.6384;175.5716;-36.9628;-35.8883" =>"Auckland City",
			"174.618;175.2888;-37.0714;-36.8391" =>"Manukau City",
			"174.8977;175.042;-37.1396;-37.0014" =>"Papakura District",
			"174.5348;175.3359;-37.5901;-36.9958" =>"Franklin District",
			),
		'Waikato Region' => array(
			";;;" => "(anywhere)",
			"174.5348;175.3359;-37.5901;-36.9958" =>"Franklin District",
			"175.3241;176.1206;-37.3049;-36.4042" =>"Thames-Coromandel District",
			"175.3023;175.9519;-37.5751;-37.1594" =>"Hauraki District",
			"174.7406;175.5521;-38.0164;-37.1786" =>"Waikato District",
			"175.3718;175.9743;-37.9579;-37.4097" =>"Matamata-Piako District",
			"175.1834;175.337;-37.8483;-37.7084" =>"Hamilton City",
			"175.0524;175.6686;-38.2083;-37.7666" =>"Waipa District",
			"174.7729;175.7031;-38.5091;-37.9483" =>"Otorohanga District",
			"175.6146;176.1597;-38.4444;-37.8876" =>"South Waikato District",
			"174.5996;175.6384;-38.7783;-38.0701" =>"Waitomo District",
			"175.5028;176.7197;-39.307;-38.2745" =>"Taupo District",
			"176.0687;176.4156;-37.7717;-37.6169" =>"Tauranga City",
			"175.9738;176.6402;-38.5785;-37.9275" =>"Rotorua District",
			),
		'Bay of Plenty Region' => array(
			";;;" => "(anywhere)",
			"175.801;176.6114;-38.0327;-37.3556" =>"Western Bay of Plenty District",
			"175.5028;176.7197;-39.307;-38.2745" =>"Taupo District",
			"176.0687;176.4156;-37.7717;-37.6169" =>"Tauranga City",
			"175.9738;176.6402;-38.5785;-37.9275" =>"Rotorua District",
			"176.4443;177.2675;-38.8623;-37.8097" =>"Whakatane District",
			"176.6394;176.7378;-38.1158;-38.0569" =>"Kawerau District",
			"177.077;178.1705;-38.5375;-37.532" =>"Opotiki District",
			),
		'Gisborne Region' => array(
			";;;" => "(anywhere)",
			"177.066;178.674;-39.002;-37.5164" =>"Gisborne District",
			),
		'Hawke\'s Bay Region' => array(
			";;;" => "(anywhere)",
			"175.5028;176.7197;-39.307;-38.2745" =>"Taupo District",
			"176.6814;178.0156;-39.3476;-38.5512" =>"Wairoa District",
			"176.1111;177.1301;-39.9155;-38.8436" =>"Hastings District",
			"176.8025;176.9295;-39.5729;-39.3866" =>"Napier City",
			"176.0801;176.9986;-40.445;-39.6624" =>"Central Hawke's Bay District",
			"175.0724;176.3782;-40.2993;-39.1296" =>"Rangitikei District",
			),
		'Taranaki Region' => array(
			";;;" => "(anywhere)",
			"173.8151;174.8764;-39.298;-38.7028" =>"New Plymouth District",
			"174.0578;175.0783;-39.4163;-38.8852" =>"Stratford District",
			"173.7503;175.0011;-39.8793;-39.1604" =>"South Taranaki District",
			),
		'Manawatu-Wanganui Region' => array(
			";;;" => "(anywhere)",
			"175.5028;176.7197;-39.307;-38.2745" =>"Taupo District",
			"174.5996;175.6384;-38.7783;-38.0701" =>"Waitomo District",
			"174.7802;176.0404;-39.6353;-38.5362" =>"Ruapehu District",
			"174.7506;175.5283;-40.0465;-39.2186" =>"Wanganui District",
			"175.2062;176.1515;-40.4462;-39.7909" =>"Manawatu District",
			"175.4917;175.7993;-40.5315;-40.2731" =>"Palmerston North City",
			"175.4486;176.6503;-40.8021;-39.9806" =>"Tararua District",
			"175.1262;175.6352;-40.7712;-40.3787" =>"Horowhenua District",
			"174.0578;175.0783;-39.4163;-38.8852" =>"Stratford District",
			"175.0724;176.3782;-40.2993;-39.1296" =>"Rangitikei District",
			),
		'Wellington Region' => array(
			";;;" => "(anywhere)",
			"175.4486;176.6503;-40.8021;-39.9806" =>"Tararua District",
			"174.8635;175.4348;-41.0151;-40.6947" =>"Kapiti Coast District",
			"174.7685;174.9974;-41.1647;-41.0029" =>"Porirua City",
			"174.9576;175.3144;-41.2282;-40.946" =>"Upper Hutt City",
			"174.8415;175.0926;-41.4379;-41.1309" =>"Lower Hutt City",
			"174.6097;174.9014;-41.3639;-41.1419" =>"Wellington City",
			"175.433;176.2936;-41.2091;-40.6684" =>"Masterton District",
			"175.2637;175.9997;-41.3739;-40.7324" =>"Carterton District",
			"174.9456;175.8217;-41.6196;-40.9118" =>"South Wairarapa District",
			),
		'Tasman Region' => array(
			";;;" => "(anywhere)",
			"172.0054;173.3695;-42.3064;-40.2946" =>"Tasman District",
			),
		'Marlborough Region' => array(
			";;;" => "(anywhere)",
			"172.7169;174.4896;-42.4878;-40.6458" =>"Marlborough District",
			),
		'West Coast Region' => array(
			";;;" => "(anywhere)",
			"171.3151;172.6941;-42.5276;-40.7655" =>"Buller District",
			"171.1232;172.2013;-42.7683;-42.0484" =>"Grey District",
			"168.033;171.8876;-44.5864;-42.4743" =>"Westland District",
			),
		'Canterbury Region' => array(
			";;;" => "(anywhere)",
			"173.1794;174.074;-42.5664;-41.9049" =>"Kaikoura District",
			"171.8731;173.5067;-43.2462;-42.083" =>"Hurunui District",
			"171.9242;172.7386;-43.4625;-42.9519" =>"Waimakariri District",
			"172.3611;173.1305;-43.9016;-43.3885" =>"Christchurch City",
//"no coodinates" => "Banks Peninsula",
			"171.0894;172.6331;-43.9061;-42.7307" =>"Selwyn District",
			"170.5686;172.2062;-44.1963;-43.0852" =>"Ashburton District",
			"170.5404;171.5247;-44.5051;-43.4493" =>"Timaru District",
			"169.792;171.2364;-44.4884;-43.3931" =>"Mackenzie District",
			"170.1684;171.2196;-44.9413;-44.3044" =>"Waimate District",
			"169.462;171.1794;-45.5854;-43.7778" =>"Waitaki District",
			),
		'Nelson Region' => array(
			";;;" => "(anywhere)",
			"173.1757;173.6017;-41.3934;-41.0511" =>"Nelson City",
			),
		'Otago Region' => array(
			";;;" => "(anywhere)",
			"169.462;171.1794;-45.5854;-43.7778" =>"Waitaki District",
			"168.7392;170.4686;-45.8366;-44.4251" =>"Central Otago District",
			"168.0767;169.7241;-45.3973;-43.9029" =>"Queenstown-Lakes District",
			"169.7164;170.7752;-46.0638;-45.2161" =>"Dunedin City",
			"168.9277;170.2324;-46.6613;-45.4345" =>"Clutha District",
			),
		'Southland Region' => array(
			";;;" => "(anywhere)",
			"166.262;169.4292;-47.3594;-44.1754" =>"Southland District",
			"168.6909;169.2263;-46.3041;-45.7818" =>"Gore District",
			"168.1749;168.5648;-46.6585;-46.3155" =>"Invercargill City",
			),
		'Chatham Islands Territory' => array(
			";;;" => "(anywhere)",
			"-177.358;-175.5;-44.6085;-43.3465" =>"Chatham Islands Territory",
			),
	);
	
	static $NZOffshoreIslands = array(
		";;;" => "(anywhere)",
		"165.8333;166.4167;-55.9500;-50.4167" => "Auckland Island",
		"178.7167;178.8333;-49.7333;-49.6333" => "Antipodes Island",
		"179.0000;179.0833;-47.7833;-46.9667" => "Bounty Islands",
		"168.9666;169.2833;-52.6333;-52.4500" => "Campbell Island",
		"-177.9833;-177.8333;-29.3166;-29.2166" => "Raoul Island",
		"166.4833;166.6333;-48.0500;-47.9833" => "Snares Island",
	);
	
	static $NZDependencies = array(
		";;;" => "(anywhere)",
		"-166.2000;-157.0000;-22.2166;-8.6333" => "Cook Islands",
		"-169.9666;-169.7666;-19.1666;-18.8666" => "Niue",
		"-172.5667;-171.1000;-8.4833;-9.4833" => "Tokelau Islands",
	);
	
	
	
	
	static function get_nzregions() {
		return self::$NZRegions;
	}

	static function get_nzta() {
		return self::$NZTA;
	}	
	
	static function get_nzplaces() {
		return self::$NZPlaces;
	}
	
	static function get_nzoffshoreislands(){
		return self::$NZOffshoreIslands;
	}

	static function get_nzdependencies(){
		return self::$NZDependencies;
	}

/**
*	get_nztla($which='')
*
* Get an array of destricts in the given region
* 
* @param 	$which	 is the region to give the districts for
*
* @return 	array of districts with coordinates as keys and The district name as value
*			or an array with the coordinates of New Zealand on an invalid region.
*
*/	
	
	static function get_nztla($which='(anywhere)'){
		if(! array_key_exists ($which, self::$NZTLA)) {$which='(anywhere)';} // returning anywhere array on spoof
		return self::$NZTLA[$which];
	}
	
}



