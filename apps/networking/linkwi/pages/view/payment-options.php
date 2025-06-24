<?php

$customer_id = $_SESSION['Userdata']['UniqueID'];
$ip_add = $_SESSION['ip_add'];
$order_id = "LW" . strtoupper(bin2hex(random_bytes(5)));
$invoice_no = date("Ymd") . rand(111111, 999999);
$data = '{&quot;X' . $customer_id . '&quot;:&quot;X' . $order_id . 'X&quot;}';
$shipping = 45;
$conn  = new dbase;

$conn->query("select * from cart where ip_add='$ip_add'");
$fetch = $conn->fetchMultiple();

$total = 0;
if (empty($fetch)) {
    header("Location: ../checkout");
    exit();
}

		//read from database
		$conn->query("select *,Null as Password from Users where UniqueID = '$customer_id'");
		$user_data = $conn->fetchSingle();
		$conn->closeConnection();
		
		if (!empty($user_data)) {

				$_SESSION['EmailAddress']		= $user_data['EmailAddress'];
				$_SESSION['FirstName']			= $user_data['FirstName'];
				$_SESSION['LastName'] 			= $user_data['LastName'];
				$_SESSION['Contact'] 			= $user_data['Contact'];
				$_SESSION['Address'] 			= $user_data['Address'];
				$_SESSION['City'] 			= $user_data['City'];
		}

foreach ($fetch as $row_cart) {


     $pro_qty = $row_cart['qty'];

    $only_price = $row_cart['p_price'];


    $sub_total = $only_price * $pro_qty;

    $total += $sub_total;
    
}
$total += $shipping;
$referalDiscount = $fetch[0]['ref_discount'];
$total = $total - $referalDiscount;


//$data = '{&quot;X'.$customer_id.'&quot;:&quot;X'.$invoice_no.'X&quot;}';
?>

<style>
.lds-ellipsis {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
}

.lds-ellipsis div {
    position: absolute;
    top: 33px;
    width: 13px;
    height: 13px;
    border-radius: 50%;
    background: #000;
    animation-timing-function: cubic-bezier(0, 1, 1, 0);
}

.lds-ellipsis div:nth-child(1) {
    left: 8px;
    animation: lds-ellipsis1 0.6s infinite;
}

.lds-ellipsis div:nth-child(2) {
    left: 8px;
    animation: lds-ellipsis2 0.6s infinite;
}

.lds-ellipsis div:nth-child(3) {
    left: 32px;
    animation: lds-ellipsis2 0.6s infinite;
}

.lds-ellipsis div:nth-child(4) {
    left: 56px;
    animation: lds-ellipsis3 0.6s infinite;
}

@keyframes lds-ellipsis1 {
    0% {
        transform: scale(0);
    }

    100% {
        transform: scale(1);
    }
}

@keyframes lds-ellipsis3 {
    0% {
        transform: scale(1);
    }

    100% {
        transform: scale(0);
    }
}

@keyframes lds-ellipsis2 {
    0% {
        transform: translate(0, 0);
    }

    100% {
        transform: translate(24px, 0);
    }
}
</style>
<main id="main">

    <!-- Home Section -->
    <section class="page-section" id="home">
        <div class="container">
            <form method="post" name="CheckoutForm">
                <h4>Delivery Address </h4>
                <div class="row  mt-3">

                    <div class="col-md-6">
                        <article class="form-group">
                            <label class="control-label">First Name</label>
                            <input class="form-control" id="s_firstname" type="text" type="text" name="s_firstname"
                                value="<?php echo $_SESSION['FirstName'] ?>" placeholder="First name" required>
                        </article>
                    </div>
                    <div class="col-md-6">
                        <article class="form-group">
                            <label class="control-label">Last Name</label>
                            <input class="form-control" id="s_lastname" type="text" type="text" name="s_lastname"
                                value="<?php echo $_SESSION['LastName'] ?>" placeholder="Last name" required>

                        </article>
                    </div>
                    <div class="col-md-6">
                        <article class="form-group">
                            <label class="control-label">Street Address</label>
                            <input class="form-control" id="s_street" type="text" type="text" name="s_street"
                                value="<?php echo $_SESSION['Address'] ?>" placeholder="Street Address" required>
                        </article>
                    </div>
                    <div class="col-md-6">
                        <article class="form-group">
                            <label class="control-label">Town / City</label>
                            <select class="form-control" id="s_town" name="s_town" required>
                                <option><?php echo $_SESSION['City']; ?></option>
                                <option>Acono</option>
                                <option>Agostini Village</option>
                                <option>All Field Trace</option>
                                <option>Alyce Glen</option>
                                <option>Apex Oil Field</option>
                                <option>Aranguez</option>
                                <option>Arena</option>
                                <option>Argyle - Kendal</option>
                                <option>Arima</option>
                                <option>Arima Heights - Temple street</option>
                                <option>Aripero</option>
                                <option>Arnos Vale</option>
                                <option>Arouca</option>
                                <option>Avocat</option>
                                <option>Bacolet</option>
                                <option>Bagatelle (Tobago)</option>
                                <option>Bagatelle Village</option>
                                <option>Balmain</option>
                                <option>Bamboo Village</option>
                                <option>Bamboo Village (Point Fortin)</option>
                                <option>Bangladesh</option>
                                <option>Barataria</option>
                                <option>Barrackpore</option>
                                <option>Basta Hall</option>
                                <option>Batchyia Village</option>
                                <option>Beaucarro - Bucarro</option>
                                <option>Beetham Estate</option>
                                <option>Bejucal</option>
                                <option>Bejucal East</option>
                                <option>Belle Garden</option>
                                <option>Belmont (Tobago)</option>
                                <option>Belmont (Trinidad)</option>
                                <option>Ben Lomond</option>
                                <option>Bennet Village</option>
                                <option>Bethel</option>
                                <option>Bethesda</option>
                                <option>Bethlehem</option>
                                <option>Betsy's Hope</option>
                                <option>Bhagna Trace</option>
                                <option>Big Yard</option>
                                <option>Black Rock</option>
                                <option>Bloody Bay</option>
                                <option>Blue Basin</option>
                                <option>Blue Range</option>
                                <option>Bois Bough</option>
                                <option>Boissiere</option>
                                <option>Bon Accord</option>
                                <option>Bon Air</option>
                                <option>Bonne Aventure</option>
                                <option>Borde narve</option>
                                <option>Brasso Caparo Village</option>
                                <option>Brasso Manuel </option>
                                <option>Brasso Tamana</option>
                                <option>Brechin Castle</option>
                                <option>Brickfield</option>
                                <option>Brighton</option>
                                <option>Broadway</option>
                                <option>Broomage</option>
                                <option>Brothers Road</option>
                                <option>Brothers Settlement</option>
                                <option>Buccoo</option>
                                <option>Buen Intento</option>
                                <option>Butler Village</option>
                                <option>Calcutta Road No. 2</option>
                                <option>Calcutta Settlement No. 2</option>
                                <option>Calder Hall - Friendsfield</option>
                                <option>California</option>
                                <option>Calvary Hill</option>
                                <option>Cameron Road</option>
                                <option>Campbellton</option>
                                <option>Canaan (Tobago)</option>
                                <option>Canaan (Trinidad)</option>
                                <option>Cane Farm</option>
                                <option>Cantaro village</option>
                                <option>Cap de Ville</option>
                                <option>Caparo</option>
                                <option>Carapichaima</option>
                                <option>Carapo</option>
                                <option>Caratal</option>
                                <option>Carenage</option>
                                <option>Carlsen Field</option>
                                <option>Carnbee</option>
                                <option>Caroni </option>
                                <option>Cascade</option>
                                <option>Castara</option>
                                <option>Caura</option>
                                <option>Cedar Hill </option>
                                <option>Cedar Hill (Princes Town)</option>
                                <option>Cedros</option>
                                <option>Centeno</option>
                                <option>Chaguanas</option>
                                <option>Chaguaramas</option>
                                <option>Champ Elysees</option>
                                <option>Champs Fleurs</option>
                                <option>Chandernagore</option>
                                <option>Charlieville</option>
                                <option>Charlo village</option>
                                <option>Charlotteville</option>
                                <option>Chase Village</option>
                                <option>Chatham</option>
                                <option>Chickland</option>
                                <option>Chin Chin</option>
                                <option>Chinese Village</option>
                                <option>Cinnamon Hall</option>
                                <option>Claxton Bay</option>
                                <option>Cleaver Heights</option>
                                <option>Cleaver Woods</option>
                                <option>Cleghorn and Mt. Pleasant</option>
                                <option>Clifton Hill</option>
                                <option>Cochrane</option>
                                <option>Cocorite</option>
                                <option>Cocoyea</option>
                                <option>Concordia</option>
                                <option>Corinth</option>
                                <option>Coromandel Settlement</option>
                                <option>Corosal</option>
                                <option>Couva</option>
                                <option>Covigne</option>
                                <option>Crown Point</option>
                                <option>Culloden</option>
                                <option>Cumaca</option>
                                <option>Cumuto</option>
                                <option>Cunaripo</option>
                                <option>Cunupia</option>
                                <option>Curepe</option>
                                <option>D'Abadie</option>
                                <option>Danny Village</option>
                                <option>Darrell Spring</option>
                                <option>De Gannes Village</option>
                                <option>Debe</option>
                                <option>Deep Ravine - Clear Water</option>
                                <option>Delaford</option>
                                <option>Delaford - Louis d'Or - Lands Settlement</option>
                                <option>Delhi Settlement</option>
                                <option>Diamond</option>
                                <option>Diamond (Penal - Debe)</option>
                                <option>Diamond Vale</option>
                                <option>Dibe - Belle Vue</option>
                                <option>Diego Martin</option>
                                <option>Diego Martin North</option>
                                <option>Dow Village</option>
                                <option>Dow Village California</option>
                                <option>Duncan Village</option>
                                <option>Dyer's village</option>
                                <option>East Port of Spain</option>
                                <option>Easterfield</option>
                                <option>Eccles Village</option>
                                <option>Edinburgh 500</option>
                                <option>Edinburgh Gardens</option>
                                <option>El Dorado</option>
                                <option>El Socorro</option>
                                <option>El Socorro Extension</option>
                                <option>Ellerslie Park</option>
                                <option>Embacadere</option>
                                <option>Endeavour</option>
                                <option>Enterprise</option>
                                <option>Esmeralda</option>
                                <option>Fairview</option>
                                <option>Fanny Village</option>
                                <option>Farnum Village</option>
                                <option>Febeau Village</option>
                                <option>Federation Park</option>
                                <option>Felicity</option>
                                <option>Felicity Hall</option>
                                <option>Fifth Company</option>
                                <option>Five Rivers</option>
                                <option>Flanagin Town</option>
                                <option>Fonrose Village</option>
                                <option>Forest Reserve</option>
                                <option>Forres Park</option>
                                <option>Frederick Settlement</option>
                                <option>Freeport</option>
                                <option>Friendship</option>
                                <option>Friendship (Penal - Debe)</option>
                                <option>Fullarton</option>
                                <option>Fyzabad </option>
                                <option>Garden Village</option>
                                <option>Gasparillo</option>
                                <option>George Village</option>
                                <option>Gheerahoo</option>
                                <option>Glamorgan</option>
                                <option>Glencoe</option>
                                <option>Golconda</option>
                                <option>Golden Lane</option>
                                <option>Gonzales</option>
                                <option>Goodwood</option>
                                <option>Goodwood Gardens</option>
                                <option>Gran Couva</option>
                                <option>Grand Curacaye</option>
                                <option>Granville</option>
                                <option>Green Hill </option>
                                <option>Guaico</option>
                                <option>Guapo Lot 10</option>
                                <option>Guaracara</option>
                                <option>Guatopajero</option>
                                <option>Gulf View</option>
                                <option>Haleland Park - Moka</option>
                                <option>Hardbargain</option>
                                <option>Harmony Hall</option>
                                <option>Harris Village</option>
                                <option>Heights of Guanapo</option>
                                <option>Hermitage (East)</option>
                                <option>Hermitage (South)</option>
                                <option>Hindustan</option>
                                <option>Homeland Gardens</option>
                                <option>Hope - Blenheim</option>
                                <option>Hope Farm - John Dial</option>
                                <option>Icacos</option>
                                <option>Idlewild</option>
                                <option>Iere Village</option>
                                <option>Indian Trail</option>
                                <option>Indian Walk</option>
                                <option>Industrial Estate</option>
                                <option>Jacob Village</option>
                                <option>Jerningham Junction</option>
                                <option>Jordan Village</option>
                                <option>Kandahar</option>
                                <option>Kelly Village</option>
                                <option>King's Bay</option>
                                <option>Kumar Village</option>
                                <option>L' Anse Mitan</option>
                                <option>L'Anse Fourmi</option>
                                <option>La Baja</option>
                                <option>La Brea</option>
                                <option>La Canoa</option>
                                <option>La Finette</option>
                                <option>La Fortune</option>
                                <option>La Horquetta</option>
                                <option>La Horquette</option>
                                <option>La Laja</option>
                                <option>La Mango Village</option>
                                <option>La Paille</option>
                                <option>La Pastora</option>
                                <option>La Puerta</option>
                                <option>La Resource North</option>
                                <option>La Romain</option>
                                <option>La Seiva</option>
                                <option>La Seiva Village</option>
                                <option>Lady Chancellor </option>
                                <option>Lambeau</option>
                                <option>Lange Park</option>
                                <option>Las Lomas No. 2</option>
                                <option>Laventille</option>
                                <option>Le Platte</option>
                                <option>Lengua</option>
                                <option>Les Coteaux</option>
                                <option>Les Efforts</option>
                                <option>Libertville</option>
                                <option>Longdenville</option>
                                <option>Lopinot</option>
                                <option>Los Bajos</option>
                                <option>Lothians</option>
                                <option>Lowlands</option>
                                <option>Lucy Vale</option>
                                <option>Macaulay</option>
                                <option>Macoya</option>
                                <option>Madras</option>
                                <option>Mafeking</option>
                                <option>Malabar</option>
                                <option>MalGretoute</option>
                                <option>Malick</option>
                                <option>Maloney</option>
                                <option>Manzanilla</option>
                                <option>Marabella</option>
                                <option>Maracas St. Joseph</option>
                                <option>Maraj Hill</option>
                                <option>Maraval </option>
                                <option>Marie Road</option>
                                <option>Mary's Hill</option>
                                <option>Mason Hall</option>
                                <option>Matilda</option>
                                <option>Maturita</option>
                                <option>Mausica</option>
                                <option>Mayaro</option>
                                <option>Mayo</option>
                                <option>Mc Bean</option>
                                <option>Melajo</option>
                                <option>Mon Desir</option>
                                <option>Mon Repos (North)</option>
                                <option>Monkey Town</option>
                                <option>Montgomery</option>
                                <option>Montrose</option>
                                <option>Mora Settlement</option>
                                <option>Moriah</option>
                                <option>Moruga</option>
                                <option>Morvant</option>
                                <option>Mount D&amp;#039;or</option>
                                <option>Mount Grace</option>
                                <option>Mount Hope</option>
                                <option>Mount Marie </option>
                                <option>Mount Pleasant</option>
                                <option>Mount St George</option>
                                <option>Mount St. Benedict</option>
                                <option>Mount Stewart</option>
                                <option>Mt Irvine</option>
                                <option>Mt Lambert</option>
                                <option>Munroe Settlement</option>
                                <option>Nancoo Village</option>
                                <option>New Grant</option>
                                <option>Newlands</option>
                                <option>North Post</option>
                                <option>O'Meara </option>
                                <option>Old Grange</option>
                                <option>Orange Grove</option>
                                <option>Orange Hill</option>
                                <option>Orange Valley</option>
                                <option>Oropuche</option>
                                <option>Ouplay Village</option>
                                <option>Palmiste (Chaguanas)</option>
                                <option>Palmiste - Rambert</option>
                                <option>Palo Seco</option>
                                <option>Paradise</option>
                                <option>Paradise (Tacarigua)</option>
                                <option>Paramin</option>
                                <option>Parforce</option>
                                <option>Parlatuvier</option>
                                <option>Parry Lands</option>
                                <option>Pasea Ext</option>
                                <option>Patience Hill</option>
                                <option>Patna Village</option>
                                <option>Pembroke</option>
                                <option>Penal</option>
                                <option>Penal Rock Road</option>
                                <option>Pepper Village (Central)</option>
                                <option>Pepper Village (South)</option>
                                <option>Perry St</option>
                                <option>Petersfield</option>
                                <option>Petit Bourg</option>
                                <option>Petit Curacaye</option>
                                <option>Petit Morne</option>
                                <option>Petit Valley</option>
                                <option>Peytonville</option>
                                <option>Phillipine</option>
                                <option>Phoenix Park</option>
                                <option>Piarco - Oropuna</option>
                                <option>Picton</option>
                                <option>Picton Hill</option>
                                <option>Pigeon Point</option>
                                <option>Pinto</option>
                                <option>Piparo</option>
                                <option>Plaisance Park</option>
                                <option>Pleasantville</option>
                                <option>Plymouth</option>
                                <option>Point Cumana</option>
                                <option>Point D'or</option>
                                <option>Point Fortin</option>
                                <option>Point Lisas</option>
                                <option>Point Lisas (NHA)</option>
                                <option>Pointe-A-Pierre</option>
                                <option>Poole</option>
                                <option>Poonah</option>
                                <option>Port of Spain</option>
                                <option>Port of Spain Port</option>
                                <option>Preysal</option>
                                <option>Princes Town</option>
                                <option>Quarry Village</option>
                                <option>Ravine Sable</option>
                                <option>Real Springs</option>
                                <option>Redhill</option>
                                <option>Reform Village</option>
                                <option>Rich Plain</option>
                                <option>Rio Claro</option>
                                <option>River Estate</option>
                                <option>Riversdale</option>
                                <option>Robert Hill </option>
                                <option>Robert Village</option>
                                <option>Rochard Rd</option>
                                <option>Romain Lands</option>
                                <option>Rousillac</option>
                                <option>Roxborough</option>
                                <option>Salazar Village</option>
                                <option>Sam Boucaud</option>
                                <option>Samaroo Village</option>
                                <option>San Fernando</option>
                                <option>San Francique</option>
                                <option>San Juan</option>
                                <option>San Rafael - Brazil</option>
                                <option>Sangre Chiquito</option>
                                <option>Sangre Grande Proper</option>
                                <option>Santa Cruz</option>
                                <option>Santa Flora</option>
                                <option>Santa Margarita</option>
                                <option>Santa Rosa</option>
                                <option>Sargeant Cain</option>
                                <option>Saut D'eau</option>
                                <option>Scarborough</option>
                                <option>Sea Lots</option>
                                <option>Sherwood Park</option>
                                <option>Sherwood Park (Tobago)</option>
                                <option>Signal Hill</option>
                                <option>Silver Stream</option>
                                <option>Simeon Road</option>
                                <option>Siparia</option>
                                <option>Sisters Village</option>
                                <option>Sixth Company</option>
                                <option>Sobo Village</option>
                                <option>Soconusco</option>
                                <option>South Oropouche</option>
                                <option>Speyside</option>
                                <option>Spring Garden</option>
                                <option>Spring Village</option>
                                <option>Spring Village (Central)</option>
                                <option>Spring Village (East)</option>
                                <option>Springland - San Fabian</option>
                                <option>St Anns</option>
                                <option>St Augustine </option>
                                <option>St Charles</option>
                                <option>St Helena</option>
                                <option>St John</option>
                                <option>St John</option>
                                <option>St Joseph</option>
                                <option>St Julien</option>
                                <option>St Lucien</option>
                                <option>St Margaret</option>
                                <option>St Marys</option>
                                <option>St Thomas</option>
                                <option>St. Augustine South</option>
                                <option>St. Barbs</option>
                                <option>St. Claire</option>
                                <option>St. Croix</option>
                                <option>St. James</option>
                                <option>St. Johns Village</option>
                                <option>St. Joseph</option>
                                <option>St. Marys (South)</option>
                                <option>St. Marys Village</option>
                                <option>Sudama Village</option>
                                <option>Surrey</option>
                                <option>Syne Village</option>
                                <option>Tabaquite</option>
                                <option>Tableland</option>
                                <option>Tacarigua</option>
                                <option>Talparo</option>
                                <option>Tarouba - Maraj Lands</option>
                                <option>Techier Village - Egypt Village</option>
                                <option>Thick</option>
                                <option>Todds Road</option>
                                <option>Todds Road Station</option>
                                <option>Top Hill</option>
                                <option>Tortuga</option>
                                <option>Trincity</option>
                                <option>Trincity Industrial Estate</option>
                                <option>Tulsa Village</option>
                                <option>Tumpuna Rd</option>
                                <option>Tunapuna</option>
                                <option>Turnure</option>
                                <option>Union Park - Union Village</option>
                                <option>Union Village</option>
                                <option>Union Village</option>
                                <option>Upper Belmont</option>
                                <option>Upper St. James </option>
                                <option>Usine Ste. Madeline</option>
                                <option>Valencia</option>
                                <option>Valley View</option>
                                <option>Valsayn</option>
                                <option>Vance River</option>
                                <option>Vessigny</option>
                                <option>Vistabella</option>
                                <option>Waddle Village</option>
                                <option>Wallerfield</option>
                                <option>Warren</option>
                                <option>Warren Village</option>
                                <option>Water Hole</option>
                                <option>Waterloo</option>
                                <option>Welcome</option>
                                <option>Wellington</option>
                                <option>Westmoorings</option>
                                <option>Whim</option>
                                <option>White Land</option>
                                <option>Williamsville</option>
                                <option>Woodbrook</option>
                                <option>Zion Hill</option>

                            </select>
                        </article>
                    </div>
                    <div class="col-md-6">
                        <article class="form-group">
                            <label class="control-label">Country</label>
                            <input class="form-control" id="s_country" type="text" type="text" name="s_country"
                                value="Trinidad and Tobago" placeholder="Country" required>

                        </article>
                    </div>
                    <div class="col-md-6">
                        <article class="form-group">
                            <label class="control-label">Phone</label>
                            <input class="form-control" id="s_contact" type="text" type="text" name="s_contact"
                                value="<?php echo $_SESSION['Contact'] ?>" placeholder="Phone" required>

                        </article>
                    </div>
                    <div class="col-md-6">
                        <article class="form-group">
                            <label class="control-label">Email</label>
                            <input class="form-control" id="s_email" type="text" type="text" name="s_email"
                                value="<?php echo $_SESSION['EmailAddress'] ?>" placeholder="Email" required>

                        </article>
                    </div>
                    <div class="col-md-6">
                        <div class="row mt-3">

                            <span class="col-9"><label class="control-label">Billing same as delivery
                                    address?</label></span>
                            <span class="col-3"><input type="checkbox" id="billingcheckbox" value="1" name="b_checkbox"
                                    class="d-inline-block" checked /></span>

                        </div>
                    </div>
                </div>
                <section class="mt-3" id="billing-form">

                    <h4>Billing Address </h4>
                    <div class="row  mt-3">
                        <div class="col-md-6">
                            <article class="form-group">
                                <label class="control-label">First Name</label>
                                <input class="form-control" id="b_firstname" type="text" name="b_firstname" value=""
                                    placeholder="First name">
                            </article>
                        </div>
                        <div class="col-md-6">
                            <article class="form-group">
                                <label class="control-label">Last Name</label>
                                <input class="form-control" id="b_lastname" type="text" name="b_lastname" value=""
                                    placeholder="Last name">
                            </article>
                        </div>
                        <div class="col-md-6">
                            <article class="form-group">
                                <label class="control-label">Street Address</label>
                                <input class="form-control" id="b_street" type="text" name="b_street" value=""
                                    placeholder="Street Address">
                            </article>
                        </div>
                        <div class="col-md-6">
                            <article class="form-group">
                                <label class="control-label">Town / City</label>
                                <select class="form-control" id="b_town" name="b_town">
                                    <option></option>
                                    <option>Acono</option>
                                    <option>Agostini Village</option>
                                    <option>All Field Trace</option>
                                    <option>Alyce Glen</option>
                                    <option>Apex Oil Field</option>
                                    <option>Aranguez</option>
                                    <option>Arena</option>
                                    <option>Argyle - Kendal</option>
                                    <option>Arima</option>
                                    <option>Arima Heights - Temple street</option>
                                    <option>Aripero</option>
                                    <option>Arnos Vale</option>
                                    <option>Arouca</option>
                                    <option>Avocat</option>
                                    <option>Bacolet</option>
                                    <option>Bagatelle (Tobago)</option>
                                    <option>Bagatelle Village</option>
                                    <option>Balmain</option>
                                    <option>Bamboo Village</option>
                                    <option>Bamboo Village (Point Fortin)</option>
                                    <option>Bangladesh</option>
                                    <option>Barataria</option>
                                    <option>Barrackpore</option>
                                    <option>Basta Hall</option>
                                    <option>Batchyia Village</option>
                                    <option>Beaucarro - Bucarro</option>
                                    <option>Beetham Estate</option>
                                    <option>Bejucal</option>
                                    <option>Bejucal East</option>
                                    <option>Belle Garden</option>
                                    <option>Belmont (Tobago)</option>
                                    <option>Belmont (Trinidad)</option>
                                    <option>Ben Lomond</option>
                                    <option>Bennet Village</option>
                                    <option>Bethel</option>
                                    <option>Bethesda</option>
                                    <option>Bethlehem</option>
                                    <option>Betsy's Hope</option>
                                    <option>Bhagna Trace</option>
                                    <option>Big Yard</option>
                                    <option>Black Rock</option>
                                    <option>Bloody Bay</option>
                                    <option>Blue Basin</option>
                                    <option>Blue Range</option>
                                    <option>Bois Bough</option>
                                    <option>Boissiere</option>
                                    <option>Bon Accord</option>
                                    <option>Bon Air</option>
                                    <option>Bonne Aventure</option>
                                    <option>Borde narve</option>
                                    <option>Brasso Caparo Village</option>
                                    <option>Brasso Manuel </option>
                                    <option>Brasso Tamana</option>
                                    <option>Brechin Castle</option>
                                    <option>Brickfield</option>
                                    <option>Brighton</option>
                                    <option>Broadway</option>
                                    <option>Broomage</option>
                                    <option>Brothers Road</option>
                                    <option>Brothers Settlement</option>
                                    <option>Buccoo</option>
                                    <option>Buen Intento</option>
                                    <option>Butler Village</option>
                                    <option>Calcutta Road No. 2</option>
                                    <option>Calcutta Settlement No. 2</option>
                                    <option>Calder Hall - Friendsfield</option>
                                    <option>California</option>
                                    <option>Calvary Hill</option>
                                    <option>Cameron Road</option>
                                    <option>Campbellton</option>
                                    <option>Canaan (Tobago)</option>
                                    <option>Canaan (Trinidad)</option>
                                    <option>Cane Farm</option>
                                    <option>Cantaro village</option>
                                    <option>Cap de Ville</option>
                                    <option>Caparo</option>
                                    <option>Carapichaima</option>
                                    <option>Carapo</option>
                                    <option>Caratal</option>
                                    <option>Carenage</option>
                                    <option>Carlsen Field</option>
                                    <option>Carnbee</option>
                                    <option>Caroni </option>
                                    <option>Cascade</option>
                                    <option>Castara</option>
                                    <option>Caura</option>
                                    <option>Cedar Hill </option>
                                    <option>Cedar Hill (Princes Town)</option>
                                    <option>Cedros</option>
                                    <option>Centeno</option>
                                    <option>Chaguanas</option>
                                    <option>Chaguaramas</option>
                                    <option>Champ Elysees</option>
                                    <option>Champs Fleurs</option>
                                    <option>Chandernagore</option>
                                    <option>Charlieville</option>
                                    <option>Charlo village</option>
                                    <option>Charlotteville</option>
                                    <option>Chase Village</option>
                                    <option>Chatham</option>
                                    <option>Chickland</option>
                                    <option>Chin Chin</option>
                                    <option>Chinese Village</option>
                                    <option>Cinnamon Hall</option>
                                    <option>Claxton Bay</option>
                                    <option>Cleaver Heights</option>
                                    <option>Cleaver Woods</option>
                                    <option>Cleghorn and Mt. Pleasant</option>
                                    <option>Clifton Hill</option>
                                    <option>Cochrane</option>
                                    <option>Cocorite</option>
                                    <option>Cocoyea</option>
                                    <option>Concordia</option>
                                    <option>Corinth</option>
                                    <option>Coromandel Settlement</option>
                                    <option>Corosal</option>
                                    <option>Couva</option>
                                    <option>Covigne</option>
                                    <option>Crown Point</option>
                                    <option>Culloden</option>
                                    <option>Cumaca</option>
                                    <option>Cumuto</option>
                                    <option>Cunaripo</option>
                                    <option>Cunupia</option>
                                    <option>Curepe</option>
                                    <option>D'Abadie</option>
                                    <option>Danny Village</option>
                                    <option>Darrell Spring</option>
                                    <option>De Gannes Village</option>
                                    <option>Debe</option>
                                    <option>Deep Ravine - Clear Water</option>
                                    <option>Delaford</option>
                                    <option>Delaford - Louis d'Or - Lands Settlement</option>
                                    <option>Delhi Settlement</option>
                                    <option>Diamond</option>
                                    <option>Diamond (Penal - Debe)</option>
                                    <option>Diamond Vale</option>
                                    <option>Dibe - Belle Vue</option>
                                    <option>Diego Martin</option>
                                    <option>Diego Martin North</option>
                                    <option>Dow Village</option>
                                    <option>Dow Village California</option>
                                    <option>Duncan Village</option>
                                    <option>Dyer's village</option>
                                    <option>East Port of Spain</option>
                                    <option>Easterfield</option>
                                    <option>Eccles Village</option>
                                    <option>Edinburgh 500</option>
                                    <option>Edinburgh Gardens</option>
                                    <option>El Dorado</option>
                                    <option>El Socorro</option>
                                    <option>El Socorro Extension</option>
                                    <option>Ellerslie Park</option>
                                    <option>Embacadere</option>
                                    <option>Endeavour</option>
                                    <option>Enterprise</option>
                                    <option>Esmeralda</option>
                                    <option>Fairview</option>
                                    <option>Fanny Village</option>
                                    <option>Farnum Village</option>
                                    <option>Febeau Village</option>
                                    <option>Federation Park</option>
                                    <option>Felicity</option>
                                    <option>Felicity Hall</option>
                                    <option>Fifth Company</option>
                                    <option>Five Rivers</option>
                                    <option>Flanagin Town</option>
                                    <option>Fonrose Village</option>
                                    <option>Forest Reserve</option>
                                    <option>Forres Park</option>
                                    <option>Frederick Settlement</option>
                                    <option>Freeport</option>
                                    <option>Friendship</option>
                                    <option>Friendship (Penal - Debe)</option>
                                    <option>Fullarton</option>
                                    <option>Fyzabad </option>
                                    <option>Garden Village</option>
                                    <option>Gasparillo</option>
                                    <option>George Village</option>
                                    <option>Gheerahoo</option>
                                    <option>Glamorgan</option>
                                    <option>Glencoe</option>
                                    <option>Golconda</option>
                                    <option>Golden Lane</option>
                                    <option>Gonzales</option>
                                    <option>Goodwood</option>
                                    <option>Goodwood Gardens</option>
                                    <option>Gran Couva</option>
                                    <option>Grand Curacaye</option>
                                    <option>Granville</option>
                                    <option>Green Hill </option>
                                    <option>Guaico</option>
                                    <option>Guapo Lot 10</option>
                                    <option>Guaracara</option>
                                    <option>Guatopajero</option>
                                    <option>Gulf View</option>
                                    <option>Haleland Park - Moka</option>
                                    <option>Hardbargain</option>
                                    <option>Harmony Hall</option>
                                    <option>Harris Village</option>
                                    <option>Heights of Guanapo</option>
                                    <option>Hermitage (East)</option>
                                    <option>Hermitage (South)</option>
                                    <option>Hindustan</option>
                                    <option>Homeland Gardens</option>
                                    <option>Hope - Blenheim</option>
                                    <option>Hope Farm - John Dial</option>
                                    <option>Icacos</option>
                                    <option>Idlewild</option>
                                    <option>Iere Village</option>
                                    <option>Indian Trail</option>
                                    <option>Indian Walk</option>
                                    <option>Industrial Estate</option>
                                    <option>Jacob Village</option>
                                    <option>Jerningham Junction</option>
                                    <option>Jordan Village</option>
                                    <option>Kandahar</option>
                                    <option>Kelly Village</option>
                                    <option>King's Bay</option>
                                    <option>Kumar Village</option>
                                    <option>L' Anse Mitan</option>
                                    <option>L'Anse Fourmi</option>
                                    <option>La Baja</option>
                                    <option>La Brea</option>
                                    <option>La Canoa</option>
                                    <option>La Finette</option>
                                    <option>La Fortune</option>
                                    <option>La Horquetta</option>
                                    <option>La Horquette</option>
                                    <option>La Laja</option>
                                    <option>La Mango Village</option>
                                    <option>La Paille</option>
                                    <option>La Pastora</option>
                                    <option>La Puerta</option>
                                    <option>La Resource North</option>
                                    <option>La Romain</option>
                                    <option>La Seiva</option>
                                    <option>La Seiva Village</option>
                                    <option>Lady Chancellor </option>
                                    <option>Lambeau</option>
                                    <option>Lange Park</option>
                                    <option>Las Lomas No. 2</option>
                                    <option>Laventille</option>
                                    <option>Le Platte</option>
                                    <option>Lengua</option>
                                    <option>Les Coteaux</option>
                                    <option>Les Efforts</option>
                                    <option>Libertville</option>
                                    <option>Longdenville</option>
                                    <option>Lopinot</option>
                                    <option>Los Bajos</option>
                                    <option>Lothians</option>
                                    <option>Lowlands</option>
                                    <option>Lucy Vale</option>
                                    <option>Macaulay</option>
                                    <option>Macoya</option>
                                    <option>Madras</option>
                                    <option>Mafeking</option>
                                    <option>Malabar</option>
                                    <option>MalGretoute</option>
                                    <option>Malick</option>
                                    <option>Maloney</option>
                                    <option>Manzanilla</option>
                                    <option>Marabella</option>
                                    <option>Maracas St. Joseph</option>
                                    <option>Maraj Hill</option>
                                    <option>Maraval </option>
                                    <option>Marie Road</option>
                                    <option>Mary's Hill</option>
                                    <option>Mason Hall</option>
                                    <option>Matilda</option>
                                    <option>Maturita</option>
                                    <option>Mausica</option>
                                    <option>Mayaro</option>
                                    <option>Mayo</option>
                                    <option>Mc Bean</option>
                                    <option>Melajo</option>
                                    <option>Mon Desir</option>
                                    <option>Mon Repos (North)</option>
                                    <option>Monkey Town</option>
                                    <option>Montgomery</option>
                                    <option>Montrose</option>
                                    <option>Mora Settlement</option>
                                    <option>Moriah</option>
                                    <option>Moruga</option>
                                    <option>Morvant</option>
                                    <option>Mount D&amp;#039;or</option>
                                    <option>Mount Grace</option>
                                    <option>Mount Hope</option>
                                    <option>Mount Marie </option>
                                    <option>Mount Pleasant</option>
                                    <option>Mount St George</option>
                                    <option>Mount St. Benedict</option>
                                    <option>Mount Stewart</option>
                                    <option>Mt Irvine</option>
                                    <option>Mt Lambert</option>
                                    <option>Munroe Settlement</option>
                                    <option>Nancoo Village</option>
                                    <option>New Grant</option>
                                    <option>Newlands</option>
                                    <option>North Post</option>
                                    <option>O'Meara </option>
                                    <option>Old Grange</option>
                                    <option>Orange Grove</option>
                                    <option>Orange Hill</option>
                                    <option>Orange Valley</option>
                                    <option>Oropuche</option>
                                    <option>Ouplay Village</option>
                                    <option>Palmiste (Chaguanas)</option>
                                    <option>Palmiste - Rambert</option>
                                    <option>Palo Seco</option>
                                    <option>Paradise</option>
                                    <option>Paradise (Tacarigua)</option>
                                    <option>Paramin</option>
                                    <option>Parforce</option>
                                    <option>Parlatuvier</option>
                                    <option>Parry Lands</option>
                                    <option>Pasea Ext</option>
                                    <option>Patience Hill</option>
                                    <option>Patna Village</option>
                                    <option>Pembroke</option>
                                    <option>Penal</option>
                                    <option>Penal Rock Road</option>
                                    <option>Pepper Village (Central)</option>
                                    <option>Pepper Village (South)</option>
                                    <option>Perry St</option>
                                    <option>Petersfield</option>
                                    <option>Petit Bourg</option>
                                    <option>Petit Curacaye</option>
                                    <option>Petit Morne</option>
                                    <option>Petit Valley</option>
                                    <option>Peytonville</option>
                                    <option>Phillipine</option>
                                    <option>Phoenix Park</option>
                                    <option>Piarco - Oropuna</option>
                                    <option>Picton</option>
                                    <option>Picton Hill</option>
                                    <option>Pigeon Point</option>
                                    <option>Pinto</option>
                                    <option>Piparo</option>
                                    <option>Plaisance Park</option>
                                    <option>Pleasantville</option>
                                    <option>Plymouth</option>
                                    <option>Point Cumana</option>
                                    <option>Point D'or</option>
                                    <option>Point Fortin</option>
                                    <option>Point Lisas</option>
                                    <option>Point Lisas (NHA)</option>
                                    <option>Pointe-A-Pierre</option>
                                    <option>Poole</option>
                                    <option>Poonah</option>
                                    <option>Port of Spain</option>
                                    <option>Port of Spain Port</option>
                                    <option>Preysal</option>
                                    <option>Princes Town</option>
                                    <option>Quarry Village</option>
                                    <option>Ravine Sable</option>
                                    <option>Real Springs</option>
                                    <option>Redhill</option>
                                    <option>Reform Village</option>
                                    <option>Rich Plain</option>
                                    <option>Rio Claro</option>
                                    <option>River Estate</option>
                                    <option>Riversdale</option>
                                    <option>Robert Hill </option>
                                    <option>Robert Village</option>
                                    <option>Rochard Rd</option>
                                    <option>Romain Lands</option>
                                    <option>Rousillac</option>
                                    <option>Roxborough</option>
                                    <option>Salazar Village</option>
                                    <option>Sam Boucaud</option>
                                    <option>Samaroo Village</option>
                                    <option>San Fernando</option>
                                    <option>San Francique</option>
                                    <option>San Juan</option>
                                    <option>San Rafael - Brazil</option>
                                    <option>Sangre Chiquito</option>
                                    <option>Sangre Grande Proper</option>
                                    <option>Santa Cruz</option>
                                    <option>Santa Flora</option>
                                    <option>Santa Margarita</option>
                                    <option>Santa Rosa</option>
                                    <option>Sargeant Cain</option>
                                    <option>Saut D'eau</option>
                                    <option>Scarborough</option>
                                    <option>Sea Lots</option>
                                    <option>Sherwood Park</option>
                                    <option>Sherwood Park (Tobago)</option>
                                    <option>Signal Hill</option>
                                    <option>Silver Stream</option>
                                    <option>Simeon Road</option>
                                    <option>Siparia</option>
                                    <option>Sisters Village</option>
                                    <option>Sixth Company</option>
                                    <option>Sobo Village</option>
                                    <option>Soconusco</option>
                                    <option>South Oropouche</option>
                                    <option>Speyside</option>
                                    <option>Spring Garden</option>
                                    <option>Spring Village</option>
                                    <option>Spring Village (Central)</option>
                                    <option>Spring Village (East)</option>
                                    <option>Springland - San Fabian</option>
                                    <option>St Anns</option>
                                    <option>St Augustine </option>
                                    <option>St Charles</option>
                                    <option>St Helena</option>
                                    <option>St John</option>
                                    <option>St John</option>
                                    <option>St Joseph</option>
                                    <option>St Julien</option>
                                    <option>St Lucien</option>
                                    <option>St Margaret</option>
                                    <option>St Marys</option>
                                    <option>St Thomas</option>
                                    <option>St. Augustine South</option>
                                    <option>St. Barbs</option>
                                    <option>St. Claire</option>
                                    <option>St. Croix</option>
                                    <option>St. James</option>
                                    <option>St. Johns Village</option>
                                    <option>St. Joseph</option>
                                    <option>St. Marys (South)</option>
                                    <option>St. Marys Village</option>
                                    <option>Sudama Village</option>
                                    <option>Surrey</option>
                                    <option>Syne Village</option>
                                    <option>Tabaquite</option>
                                    <option>Tableland</option>
                                    <option>Tacarigua</option>
                                    <option>Talparo</option>
                                    <option>Tarouba - Maraj Lands</option>
                                    <option>Techier Village - Egypt Village</option>
                                    <option>Thick</option>
                                    <option>Todds Road</option>
                                    <option>Todds Road Station</option>
                                    <option>Top Hill</option>
                                    <option>Tortuga</option>
                                    <option>Trincity</option>
                                    <option>Trincity Industrial Estate</option>
                                    <option>Tulsa Village</option>
                                    <option>Tumpuna Rd</option>
                                    <option>Tunapuna</option>
                                    <option>Turnure</option>
                                    <option>Union Park - Union Village</option>
                                    <option>Union Village</option>
                                    <option>Union Village</option>
                                    <option>Upper Belmont</option>
                                    <option>Upper St. James </option>
                                    <option>Usine Ste. Madeline</option>
                                    <option>Valencia</option>
                                    <option>Valley View</option>
                                    <option>Valsayn</option>
                                    <option>Vance River</option>
                                    <option>Vessigny</option>
                                    <option>Vistabella</option>
                                    <option>Waddle Village</option>
                                    <option>Wallerfield</option>
                                    <option>Warren</option>
                                    <option>Warren Village</option>
                                    <option>Water Hole</option>
                                    <option>Waterloo</option>
                                    <option>Welcome</option>
                                    <option>Wellington</option>
                                    <option>Westmoorings</option>
                                    <option>Whim</option>
                                    <option>White Land</option>
                                    <option>Williamsville</option>
                                    <option>Woodbrook</option>
                                    <option>Zion Hill</option>

                                </select>
                            </article>
                        </div>
                        <div class="col-md-6">
                            <article class="form-group">
                                <label class="control-label">Country</label>
                                <input class="form-control" id="b_country" type="text" name="b_country" value=""
                                    placeholder="Country">
                            </article>
                        </div>
                        <div class="col-md-6">
                            <article class="form-group">
                                <label class="control-label">Phone</label>
                                <input class="form-control" id="b_contact" type="text" type="text" name="b_contact"
                                    value="" placeholder="Phone">
                            </article>
                        </div>
                        <div class="col-md-6">
                            <article class="form-group">
                                <label class="control-label">Email</label>
                                <input class="form-control" id="b_email" type="text" name="b_email" value=""
                                    placeholder="Email">
                            </article>
                        </div>
                    </div>




                </section><br /><br />
                <label>
                    <h5 class="">Payment Options Available</h5>
                </label>
                <div class="col-md-12  pl-0">

                    <button type="submit" class="mt-3 btn btn-mod btn-large btn-round">PAY WITH WIPAY</button>
                    <br /><br />
                    <span style='display:none' id="loading" class="loading">Please wait while we process your
                        information...</span>
                    <div style='display:none' class="lds-ellipsis loading">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>

            </form>
            <?php

            function testfun($customer_id)
            {

                $url = "order/linkw6789RE98FOR43212345$customer_id";
                $url .= "194354HJ856VS256U56TY56L/$invoice_no";

                header("Location: $url");
            }

            if (array_key_exists('pay_offline', $_POST)) {
                testfun($customer_id);
            }

            ?>

        </div>
    </section>
</main>
<script>
function show() {
    let x = document.querySelectorAll(".loading");

    Array.from(x).map((item) => {
        if (item.style.display === "none") {
            item.style.display = "block";
            document.querySelector(".loader").style.display = "block";
            document.querySelector(".page-loader").style.display = "block";
            document.querySelector(".page-loader").style.opacity = "0.6";
        } else {
            item.style.display = "none";
        }
    })

}

//hide and show
$(document).ready(function() {
    $('#billing-form').hide();
    $('#billingcheckbox').click(function() {
        var $this = $(this);
        if ($this.is(':checked')) {
            $(this).val('1');
            $('#billing-form').hide();

            document.getElementById("s_firstname").value;
            let bill = $('#billing-form input').toArray();

            bill.map((item) => {
                item.setAttribute("hidden", true);
                item.removeAttribute("required");
            })
        } else {
            $('#billing-form').show();
            $(this).val('0');
            let bill = $('#billing-form input').toArray();
            bill.map((item) => {
                item.removeAttribute("hidden");
                item.setAttribute("required", true);

            })

        }
    });
});
const checkoutForm = document.forms.CheckoutForm;
checkoutForm.addEventListener("submit", function(evt) {
    evt.preventDefault();
    payWiPay();
    show();
});

function payWiPay() {
    let s_firstname = document.getElementById("s_firstname").value;
    let s_lastname = document.getElementById("s_lastname").value;
    let s_street = document.getElementById("s_street").value;
    let s_town = document.getElementById("s_town").value;
    let s_country = document.getElementById("s_country").value;
    let s_contact = document.getElementById("s_contact").value;
    let s_email = document.getElementById("s_email").value;

    let b_firstname = document.getElementById("b_firstname").value;
    let b_lastname = document.getElementById("b_lastname").value;
    let b_street = document.getElementById("b_street").value;
    let b_town = document.getElementById("b_town").value;
    let b_country = document.getElementById("b_country").value;
    let b_contact = document.getElementById("b_contact").value;
    let b_email = document.getElementById("b_email").value;

    if (document.getElementById("billingcheckbox").value == '1') {
        b_firstname = s_firstname;
        b_lastname = s_lastname
        b_street = s_street
        b_town = s_town
        b_country = s_country
        b_contact = s_contact
        b_email = s_email
    }


    const headers = new Headers();
    headers.append('Accept', 'application/json');
    var parameters = new URLSearchParams();
    parameters.append('account_number', '5845179505');
    parameters.append('avs', '0');
    parameters.append('country_code', 'TT');
    parameters.append('currency', 'TTD');
    parameters.append(
        "data",
        '{"s_firstname":"' +
        s_firstname +
        '","s_lastname":"' +
        s_lastname +
        '","s_street":"' +
        s_street +
        '","s_town":"' +
        s_town +
        '","s_country":"' +
        s_country +
        '","s_contact":"' +
        s_contact +
        '","s_email":"' +
        s_email +
        '","b_firstname":"' +
        b_firstname +
        '","b_lastname":"' +
        b_lastname +
        '","b_street":"' +
        b_street +
        '","b_town":"' +
        b_town +
        '","b_country":"' +
        b_country +
        '","b_contact":"' +
        b_contact +
        '","b_email":"' +
        b_email +
        '","ref_discount":"' +
        '<?php echo $referalDiscount ?>' +
        '"}'
    );
    parameters.append('environment', 'live');
    parameters.append('fee_structure', 'merchant_absorb');
    parameters.append('method', 'credit_card');
    parameters.append('order_id', '<?php echo $order_id ?>');
    parameters.append('origin', 'LinkWi_App');
    parameters.append('response_url',
        'https://linkwi.co/wipay/go/');
    parameters.append('total', '<?php echo $total ?>.00');
    var options = {
        method: 'POST',
        headers: headers,
        body: parameters,
        redirect: 'follow'
    };
    fetch('https://tt.wipayfinancial.com/plugins/payments/request', options)
        .then(response => response.text())
        .then(result => {
            // result in JSON format (header)
            result = JSON.parse(result);
            document.querySelector("#loading").innerText = "Redirecting to payment page...";
            // perform redirect
            window.location.href = result.url;
        })
        .catch(error => console.log('error', error));
}
</script>