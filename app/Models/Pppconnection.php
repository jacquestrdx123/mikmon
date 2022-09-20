<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pppconnection extends Model
{
    use HasFactory;

    protected $fillable =[
        'device_id',
        'name',
        "caller-id",
        "service",
        "address",
        "radius",
        "uptime",
    ];

    public static function updatePPP(){
        $customerlist  = array(
            "etoos007" => "thysoosthuizen@swstilbaai",
            "etbur005" => "gysbertburger@swstilbaai",
            "etgat001" => "gattisstilbaai@swstilbaai",
            "etpri111" => "shaunprinsloo@swstilbaai",
            "etdev007" => "harrydevilliers@swstilbaai",
            "etlen007" => "leonardprinsloo@swstilbaai",
            "etdev003" => "paulrichdevilliers@swstilbaai",
            "etoos002" => "riaanoosthuizen@swstilbaai",
            "poy001" => "alecpoynting@swstilbaai",
            "sjf001" => "johanwasserman@swstilbaai",
            "etsjf002" => "jennywasserman@swstilbaai",
            "sco001" => "scorpiocarriersleonrenateengelke@swstilbaai",
            "etmul001" => "frikkiemuller@swstilbaai",
            "etsmi010" => "ruanwesselsmit@swstilbaai",
            "ethor111" => "kippiehorn@swstilbaai",
            "etzou001" => "engelahorn@swstilbaai",
            "van010" => "annelievandeventer@swstilbaai",
            "etoos900" => "williejoosthuizen@swstilbaai",
            "etcro004" => "japiecronje@swstilbaai",
            "etrad001" => "neliusrademan@swstilbaai",
            "ethof001" => "andrehoffman@swstilbaai",
            "etrai001" => "rainbowcivilsraymond@swstilbaai",
            "etera009" => "lourenserasmus@swstilbaai",
            "ethum005" => "martiehuman@swstilbaai",
            "pet001" => "ericpetersen@swstilbaai",
            "sup001" => "isabelkleinhans@swstilbaai",
            "etpoi002" => "brahmleroux@swstilbaai",
            "fie001" => "francoisfielies@swstilbaai",
            "etkvz002" => "karinvanzyl@swstilbaai",
            "etjvr300" => "johanvanrhyn@swstilbaai",
            "etscp001" => "southcapepoles@swstilbaai",
            "etbri897" => "alaricebrink@swstilbaai",
            "etvan002" => "mariaantjaartvanderwalt@swstilbaai",
            "etmyb001" => "tielmanmyburgh@swstilbaai",
            "etsch004" => "marcoscheffer@swstilbaai",
            "etpri200" => "isakprinsloo@swstilbaai",
            "etdej004" => "elsabedejager@swstilbaai",
            "etnau915" => "desireenaude@swstilbaai",
            "etpie003" => "willempieters@swstilbaai",
            "etste007" => "johanbrendasteenkamp@swstilbaai",
            "etnel916" => "annelizenel@swstilbaai",
            "etnel010" => "willemnel@swstilbaai",
            "etpun003" => "ameliapunt@swstilbaai",
            "ethin002" => "rolandghindle@swstilbaai",
            "etaqu001" => "hannesleroux@swstilbaai",
            "etpot002" => "benpotgieter@swstilbaai",
            "etdir001" => "mullerdirksen@swstilbaai",
            "etler002" => "patleroux@swstilbaai",
            "etdup003" => "thysdupreez@swstilbaai",
            "etsal002" => "salonriette@swstilbaai",
            "etalb005" => "dionealberts@swstilbaai",
            "etmei008" => "faniemeiring@swstilbaai",
            "etcop002" => "jacqueslabuschaigne@swstilbaai",
            "etale004" => "peteralexander@swstilbaai",
            "etroo001" => "altaroodman@swstilbaai",
            "etdou001" => "shaunerroldoubell@swstilbaai",
            "kur003" => "bernardrachelkurten@swstilbaai",
            "etgoo005" => "lodewykwilhelmgoosen@swstilbaai",
            "etgro004" => "stefangrove@swstilbaai",
            "etter006" => "eugenevanderwalt@swstilbaai",
            "etver400" => "carolinevermooten@swstilbaai",
            "etens001" => "charlenslin@swstilbaai",
            "etfou001" => "martjiejohanfourie@swstilbaai",
            "etvan048" => "elzettevanschalkwyk@swstilbaai",
            "ethar007" => "basjanhatting@swstilbaai",
            "etdup005" => "elizmaduplessis@swstilbaai",
            "etpre004" => "johancloete@swstilbaai",
            "etmat004" => "johannesmathewson@swstilbaai",
            "etoos500" => "stefanoosthuizen@swstilbaai",
            "etwou002" => "ruthwoudstra@swstilbaai",
            "etkat898" => "janetkatzke@swstilbaai",
            "etroo005" => "johanroodman@swstilbaai",
            "etgoo004" => "johangoosen@swstilbaai",
            "etnie003" => "johanvanniekerk@swstilbaai",
            "etdey003" => "roydeysel@swstilbaai",
            "etdel001" => "petrusdelange@swstilbaai",
            "col002" => "johancollins@swstilbaai",
            "etgou007" => "dantegous@swstilbaai",
            "etpla003" => "peterplaatjies@swstilbaai",
            "etdur001" => "frikkiedurand@swstilbaai",
            "etpri003" => "hendrikprinsloo@swstilbaai",
            "etkas001" => "lynnkasselman@swstilbaai",
            "etmel005" => "melaniepotgieter@swstilbaai",
            "etcla012" => "terranceclarke@swstilbaai",
            "etove001" => "gerhardoverbeek@swstilbaai",
            "etkro303" => "thomaskromker@swstilbaai",
            "oly001" => "matthewanderson@swstilbaai",
            "pal003" => "garypanton@swstilbaai",
            "riv002" => "thysbender@swstilbaai",
            "etavh002" => "annavanheerden@swstilbaai",
            "etwil002" => "wilcovanrensburg@swstilbaai",
            "ethen001" => "jjjohanhenn@swstilbaai",
            "del001" => "michelledelange@swstilbaai",
            "etdupo002" => "cyladuplessis@swstilbaai",
            "etvdv001" => "sakkievandervyver@swstilbaai",
            "etlom002" => "zybrandlombaard@swstilbaai",
            "etsto004" => "annemiestoman@swstilbaai",
            "etpkk001" => "kearneytheron@swstilbaai",
            "etpum001" => "colleencilliers@swstilbaai",
            "etpre002" => "koospretorius@swstilbaai",
            "etkim003" => "kimvanschoor@swstilbaai",
            "etdeb003" => "pieterdebruin@swstilbaai",
            "etrau001" => "andrerautenbach@swstilbaai",
            "etsun002" => "vanessamalvicini@swstilbaai",
            "etver003" => "johannievermeulen@swstilbaai",
            "etpri007" => "charlprinsloo@swstilbaai",
            "etnie004" => "charlnieuwendyk@swstilbaai",
            "etvan334" => "johanvanderpoel@swstilbaai",
            "etcjh001" => "andrematheee@swstilbaai",
            "etnel002" => "michaunel@swstilbaai",
            "etfox002" => "jaquelienfox@swstilbaai",
            "etahr004" => "peggyahrens@swstilbaai",
            "etghi001" => "ghianissteakgrill@swstilbaai",
            "inv002" => "inverrochedistillery@swstilbaai",
            "etdom005" => "willemdoman@swstilbaai",
            "etbos004" => "ingebreed@swstilbaai",
            "etsmi006" => "jacobushendriksmit@swstilbaai",
            "etbas099" => "andrebasson@swstilbaai",
            "etweh001" => "helenwehmeyer@swstilbaai",
            "mey001" => "yvettemeyer@swstilbaai",
            "etdan003" => "rosinadaniels@swstilbaai",
            "etjoo001" => "rianajooste@swstilbaai",
            "etcoc002" => "derrickcochran@swstilbaai",
            "etvdm400" => "heinvdmerwe@swstilbaai",
            "etjvr003" => "charlkrumm@swstilbaai",
            "etsun003" => "sunscapeaccommodation@swstilbaai",
            "ethin004" => "neilhindle@swstilbaai",
            "ssk880" => "pietieuys@swstilbaai",
            "etpri005" => "nicoprinsloo@swstilbaai",
            "etrob001" => "engelaroberts@swstilbaai",
            "etpot004" => "wynandpotgieter@swstilbaai",
            "ethil001" => "hiltonprojects@swstilbaai",
            "etdve001" => "dirkvaneeden@swstilbaai",
            "etrou001" => "carrolroux@swstilbaai",
            "etpro002" => "cajvanzyl@swstilbaai",
            "etsto001" => "benstoop@swstilbaai",
            "etvan017" => "wilhelmvanzyl@swstilbaai",
            "etjon004" => "danievanrensburg@swstilbaai",
            "etmel002" => "nielmelrose@swstilbaai",
            "etell001" => "celenteellis@swstilbaai",
            "etbau006" => "barbarabauer@swstilbaai",
            "etcro021" => "jeancrous@swstilbaai",
            "etswa112" => "bertusswanepoel@swstilbaai",
            "etlom200" => "torlombard@swstilbaai",
            "etaud004" => "heatheraudsitore@swstilbaai",
            "ethar384" => "lindahart@swstilbaai",
            "etrob002" => "leonardbarendroberts@swstilbaai",
            "etlud002" => "fransludeck@swstilbaai",
            "etbri006" => "mariebrits@swstilbaai",
            "etsto006" => "abriettesenekal@swstilbaai",
            "etcel001" => "charlcelliers@swstilbaai",
            "etgsg002" => "oliviavdmerwe@swstilbaai",
            "etuni001" => "antonvanzyl@swstilbaai",
            "etvan009" => "salomevanheerden@swstilbaai",
            "etfar003" => "wesleyfarrell@swstilbaai",
            "etvlo006" => "pietervlok@swstilbaai",
            "ettim901" => "shaunwesstraad@swstilbaai",
            "etlou001" => "chrisamandalouw@swstilbaai",
            "etrei002" => "jenniferreinders@swstilbaai",
            "etjou105" => "altusjoubertskrywershuis@swstilbaai",
            "etjou107" => "altusjoubertoffice@swstilbaai",
            "etjou104" => "altusjouberttheboathouse@swstilbaai",
            "etjou103" => "altusjoubertmuffets@swstilbaai",
            "etjou101" => "altusjoubertdina@swstilbaai",
            "etjou102" => "altusjoubertmilkwood@swstilbaai",
            "etjou106" => "altusjoubertreception@swstilbaai",
            "etjou111" => "altusjoubertdeli@swstilbaai",
            "etdew008" => "tanyadewaal@swstilbaai",
            "etjou112" => "altusjoubertrestaurant@swstilbaai",
            "etjou100" => "altusjoubertanna@swstilbaai",
            "doo001home" => "pietervandeventer@swstilbaai",
            "etsom001" => "andriesduminy@swstilbaai",
            "etbar001" => "elizebarnard@swstilbaai",
            "etvan013" => "blanchevanwyk@swstilbaai",
            "ssk907" => "pietlourens@swstilbaai",
            "vos002" => "esiasvosloo@swstilbaai",
            "etdup004" => "charlduplessis@swstilbaai",
            "vos001" => "esiasvosloo@swstilbaai",
            "smu001" => "samanthaboolsmuts@swstilbaai",
            "etpey001" => "eleanepeyper@swstilbaai",
            "etkil003" => "philipkilian@swstilbaai",
            "etcro003" => "georgecronje@swstilbaai",
            "etden002" => "corneliusdenecker@swstilbaai",
            "van041" => "gerhardvanbosch@swstilbaai",
            "bat001" => "gilesecbates@swstilbaai",
            "etkvb003" => "marilizepotgieter@swstilbaai",
            "etmal009" => "francoismalherbe@swstilbaai",
            "etoos001" => "riaanemmaoosthuizen@swstilbaai",
            "ssk723" => "kobushorne@swstilbaai",
            "etste004" => "daniejstegmann@swstilbaai",
            "etste005" => "jancorstegmann@swstilbaai",
            "etdav001" => "zandradavids@swstilbaai",
            "etsmi002" => "cobussmith@swstilbaai",
            "ssk406" => "abieterblanche@swstilbaai",
            "etheh001" => "heimenhelenabotha@swstilbaai",
            "etfou004" => "cloeteenbelindafourie@swstilbaai",
            "etkvb001" => "louisvandyk@swstilbaai",
            "etdut110" => "andredutoit@swstilbaai",
            "etbat902" => "guybate@swstilbaai",
            "etjou001" => "wendyjoubert@swstilbaai",
            "etaus001" => "sariecoetzee@swstilbaai",
            "etbey004" => "christinebeytell@swstilbaai",
            "etbot002" => "philipbotha@swstilbaai",
            "etfou010" => "wilhelmfourie@swstilbaai",
            "etbre010" => "ronelbredenhann@swstilbaai",
            "etwic002" => "henrydvwickens@swstilbaai",
            "etlou908" => "yolandelouw@swstilbaai",
            "etgre909" => "madelainegreenwood@swstilbaai",
            "etpro004" => "jackprobart@swstilbaai",
            "etmul008" => "erikamuller@swstilbaai",
            "etwil922" => "albertwillers@swstilbaai",
            "etkru894" => "hannokruger@swstilbaai",
            "etsan899" => "marksanderson@swstilbaai",
            "etcoe010" => "izakcoetzee@swstilbaai",
            "etmoo002" => "johnmoodie@swstilbaai",
            "lis001" => "jonathanbarry@swstilbaai",
            "ssk4068" => "hoekraallandgoedstaljohannel@swstilbaai",
            "ssk4068huis" => "hoekraallandgoedhuisjohannel@swstilbaai",
            "etkly001" => "theokleynhans@swstilbaai",
            "etcou001" => "esjaoosthuizen@swstilbaai",
            "etpec001" => "carmenjpecararo@swstilbaai",
            "etphi001" => "petrusphilander@swstilbaai",
            "ethof002" => "carmenpecararo@swstilbaai",
            "etdut002" => "huiszenobiadutoitadmin@swstilbaai",
            "etjan011" => "christenejansenvanrensburg@swstilbaai",
            "etoos101" => "esjaoosthuizen@swstilbaai",
            "etkle200" => "ralphkleynhans@swstilbaai",
            "etedw893" => "lawrenceedwards@swstilbaai",
            "etmey004" => "veronicameyers@swstilbaai",
            "etdup007" => "robertbenjamindupreez@swstilbaai",
            "etgro001" => "stiaangrobler@swstilbaai",
            "ssk880heid" => "pkuyslizette@swstilbaai",
            "etbre005" => "apbreytenbachantonduplessis@swstilbaai",
            "etvol009" => "willievolschenk@swstilbaai",
            "etkru001" => "leokruger@swstilbaai",
            "etgre001" => "reinholdgregorowski@swstilbaai",
            "etkni002" => "eleanorvanniekerk@swstilbaai",
            "etpot007" => "hermanpotgieter@swstilbaai",
            "etpot008" => "raldupotgieter@swstilbaai",
            "etoos014" => "nicolaasoosthuizen@swstilbaai",
            "etpre333" => "dewaldpretorius@swstilbaai",
            "etcra911" => "rinacrause@swstilbaai",
            "etsan913" => "francescasandes@swstilbaai",
            "etsyr001" => "annatjievandermerwe@swstilbaai",
            "etfer002" => "eurekaferreira@swstilbaai",
            "dup005" => "alidaduplessis@swstilbaai",
            "etvan005" => "pietervanniekerk@swstilbaai",
            "etlam003" => "stephanlamprecht@swstilbaai",
            "etvis105" => "luciavisser@swstilbaai",
            "etkig002" => "carolineolivier@swstilbaai",
            "etzic001" => "francoisstrauss@swstilbaai",
            "etmas919" => "pietermassyn@swstilbaai",
            "etola001" => "olausvanzyl@swstilbaai",
            "etvis009" => "lizettevisser@swstilbaai",
            "etral001" => "georgejacksonrall@swstilbaai",
            "ethil004" => "janwillemwessels@swstilbaai",
            "etsep006" => "eltonseptember@swstilbaai",
            "etpla905" => "henryplaatjies@swstilbaai",
            "etarm906" => "nicoarmoed@swstilbaai",
            "etrad005" => "pieterrademan@swstilbaai",
            "etkok001" => "henrekok@swstilbaai",
            "etfor001" => "adrianfortuin@swstilbaai",
            "mal003" => "koosmalan@swstilbaai",
            "ethar100" => "isakhartnick@swstilbaai",
            "sskq7655" => "anne-lizeuys@swstilbaai",
            "etbmb001" => "marlizemouton@swstilbaai",
            "etuys021" => "carinauys@swstilbaai",
            "ethea001" => "davidheathcock@swstilbaai",
            "etlou002" => "dewetlourens@swstilbaai",
            "etlov002" => "greglove@swstilbaai",
            "etpee001" => "lourensswart@swstilbaai",
            "etsho002" => "wayneshonfeld@swstilbaai",
            "etsta004" => "francoisstaples@swstilbaai",
            "etpie122" => "basilpienaar@swstilbaai",
            "etcra005" => "crawford'scarpetandblindscc@swstilbaai",
            "etnen001" => "nenohaasbroekjnr@swstilbaai",
            "etbra002" => "loodvandeventer@swstilbaai",
            "etsta002" => "stainlessteelworxshoplourensbotha@swstilbaai",
            "etmid001" => "charlesmiddleton@swstilbaai",
            "etmey009" => "ahnmeyer@swstilbaai",
            "etpri010" => "gretheprins@swstilbaai",
            "etfar009" => "rolenefarre@swstilbaai",
            "etham001" => "jeannehamman@swstilbaai",
            "etsee002" => "maniesteyn@swstilbaai",
            "etand001" => "diananderson@swstilbaai",
            "etbak001" => "reginaldbaker@swstilbaai",
            "etpre001" => "annemariepretorius@swstilbaai",
            "etcro005" => "pierrecronje@swstilbaai",
            "etris001" => "carelrischmuller@swstilbaai",
            "etsch009" => "annelisescholtz@swstilbaai",
            "etmym001" => "nickbernard@swstilbaai",
            "etpre019" => "williepretoriusriavdwesthuizen@swstilbaai",
            "etwhi895" => "dianewhite@swstilbaai",
            "etllo001" => "simonlloyd@swstilbaai",
            "etlej002" => "petrusweyers@swstilbaai",
            "ettai005" => "michelletait@swstilbaai",
            "kle004" => "galekleinhans@swstilbaai",
            "etrie300" => "nicolpereira@swstilbaai",
            "etbar002" => "antonbartman@swstilbaai",
            "etvan006" => "jacobusvantonder@swstilbaai",
            "etkoe003" => "chriskoen@swstilbaai",
            "etgaz001" => "dylanreynders@swstilbaai",
            "etdvs002" => "danievanstaden@swstilbaai",
            "etbre001" => "suemartinbreek@swstilbaai",
            "etvan026" => "corvantonder@swstilbaai",
            "etcoa001" => "jamescoates@swstilbaai",
            "etsad002" => "anniesadie@swstilbaai",
            "etvor001" => "vorentoetrustfrancoisuyslafras@swstilbaai",
            "doo002" => "christivandeventer@swstilbaai",
            "ssk3100" => "dedriphilipdebruynwessels@swstilbaai",
            "etste006" => "martinsteyn@swstilbaai",
            "eteng001" => "albertengelbrecht@swstilbaai",
            "etpav001" => "pavatitradingptyltdjohan@swstilbaai",
            "etamo001" => "sylviaamos@swstilbaai",
            "etvon004" => "ronellevonlandsberg@swstilbaai",
            "etdeb002" => "johanenmaureendebeer@swstilbaai",
            "etmul004" => "annemariemulderrepeater@swstilbaai",
            "etmul007" => "ciscamullerrinagouws@swstilbaai",
            "etsla007" => "chrisslabber@swstilbaai",
            "ethan899" => "tobiashanekom@swstilbaai",
            "etler917" => "johanleroux@swstilbaai",
            "etgri002" => "adelegriffiths@swstilbaai",
            "etsch001" => "naasscholtz@swstilbaai",
            "etmal008" => "ronelmalan@swstilbaai",
            "etjon010" => "nicojonker@swstilbaai",
            "etbou005" => "bouwerflooringcandice@swstilbaai",
            "etbot019" => "lourensbothahuis@swstilbaai",
            "etbot001" => "ajmonicabotha@swstilbaai",
            "etmyr001" => "myrtlesretreatmyrtle@swstilbaai",
            "etali001" => "alikreukelgastehuis@swstilbaai",
            "ettho004" => "georgethom@swstilbaai",
            "etvel002" => "janveldsman@swstilbaai",
            "etgro008" => "adelegroenewaldshield@swstilbaai",
            "etjac001" => "johanjacobs@swstilbaai",
            "etbas009" => "nicobasson@swstilbaai",
            "etkar006" => "karlienvanzyl@swstilbaai",
            "etbar004" => "charlbarnard@swstilbaai",
            "etfou018" => "alexfourie@swstilbaai",
            "etviv001" => "lindaviviers@swstilbaai",
            "etvan900" => "magrietvanrensburg@swstilbaai",
            "etmar007" => "mattheusmaree@swstilbaai",
            "ethel001" => "esthiahelmand@swstilbaai",
            "etlai001" => "hendrikflaing@swstilbaai",
            "etklu002" => "tersiatheokluits@swstilbaai",
            "ethai001" => "erichains@swstilbaai",
            "ettor002" => "cornetheunissen@swstilbaai",
            "etthe005" => "francoistheron@swstilbaai",
            "etove003" => "gerhardoverbeek@swstilbaai",
            "etgru002" => "wernergruting@swstilbaai",
            "etstr008" => "andreastrydom@swstilbaai",
            "etbro004" => "hughduncanbrown@swstilbaai",
            "etbre011" => "gerbrandbreed@swstilbaai",
            "etbeu003" => "tanjabeukes@swstilbaai",
            "etzee002" => "pierrezeelie@swstilbaai",
            "ethon003" => "johannahoneyman@swstilbaai",
            "etwen002" => "ezawentzel@swstilbaai",
            "etgel005" => "mariageldenhuys@swstilbaai",
            "etcon222" => "steveconradie@swstilbaai",
            "etblo002" => "lizettebloem@swstilbaai",
            "etmey002" => "phillipmeyer@swstilbaai",
            "etuys009" => "christauys@swstilbaai",
            "etpal004" => "jaconepgen@swstilbaai",
            "etjou403" => "altusjoubertma@swstilbaai",
            "sbt001" => "stilbaaitoerisme@swstilbaai",
            "etgor400" => "riettegordon@swstilbaai",
            "etmor001" => "kevinmoran@swstilbaai",
            "etkad001" => "nenohaasbroek@swstilbaai",
            "etsch003" => "janviljoen@swstilbaai",
            "etpco001" => "pcopieteroosthuizen@swstilbaai",
            "etjan001" => "herbertyolandajansenvanrensburg@swstilbaai",
            "etsar010" => "cherylsargent@swstilbaai",
            "etdew006" => "stewartdewet@swstilbaai",
            "etsch111" => "neliaenandreschreuder@swstilbaai",
            "etden001" => "denzilvandermerwe@swstilbaai",
            "etoos010" => "mariaoosthuizen@swstilbaai",
            "ettai003" => "schalktait@swstilbaai",
            "etvan204" => "nicovandiemen@swstilbaai",
            "etrol001" => "jacquesroller@swstilbaai",
            "ettho003" => "craigthorne@swstilbaai",
            "ethil002" => "hiltonprojectsdianbothma@swstilbaai",
            "etout001" => "andrewcronje@swstilbaai",
            "etdut003" => "calladutoit@swstilbaai",
            "etbuy003" => "danielbuys@swstilbaai",
            "etdah003" => "karldahl@swstilbaai",
            "etloo002" => "nelusloots@swstilbaai",
            "etwel001" => "williewelman@swstilbaai",
            "etpot001" => "jacopotgieter@swstilbaai",
            "etmar004" => "tinusmaree@swstilbaai",
            "etera003" => "henrietteerasmus@swstilbaai",
            "etfer006" => "georgeferns@swstilbaai",
            "etpot010" => "rochepotgieter@swstilbaai",
            "etrex002" => "anthonytomjones@swstilbaai",
            "etkla010" => "taniapretorius@swstilbaai",
            "etfou903" => "jeanettevanrhyn@swstilbaai",
            "etwas001" => "nicowasserman@swstilbaai",
            "etjon007" => "danettejones@swstilbaai",
            "etvan222" => "antonvanzylmoquini@swstilbaai",
            "ethum008" => "evettehuman@swstilbaai",
            "etott004" => "andreotto@swstilbaai",
            "etste001" => "sterrehemel@swstilbaai",
            "etmar002" => "maureenmarud@swstilbaai",
            "etvan042" => "csvanstaden@swstilbaai",
            "etnel005" => "louisanel@swstilbaai",
            "etgen003" => "genevievemarx@swstilbaai",
            "etode010" => "marindaodendaal@swstilbaai",
            "etbeg001" => "gjbegemann@swstilbaai",
            "etpie001" => "pinepienaar@swstilbaai",
            "etfou002" => "nelfourie@swstilbaai",
            "etbur007" => "schalkburger@swstilbaai",
            "etjou113" => "altusjoubertchefcarla@swstilbaai",
            "etspi100" => "johanspies@swstilbaai",
            "etalb002" => "suealbertyn@swstilbaai",
            "etavw001" => "annamartvanwyk@swstilbaai",
            "etcoe004" => "jacocoetzee@swstilbaai",
            "etswa001" => "shawnswart@swstilbaai",
            "etgen002" => "genoaconsultingarnomeyer@swstilbaai",
            "etbar006" => "johanbarnardplainsite@swstilbaai",
            "etcon001" => "conceptpublishingcchenkbotes@swstilbaai",
            "van040" => "karinavanhuyssteen@swstilbaai",
            "etnel003" => "deannel@swstilbaai",
            "etkru111" => "martinkrugel@swstilbaai",
            "etnel400" => "hennanel@swstilbaai",
            "etvdw111" => "hennievanderwaltjackie@swstilbaai",
            "etsar001" => "houseofsarah@swstilbaai",
            "etjcv001" => "mariethavolschenk@swstilbaai",
            "etkni001" => "knijperskreatiefworkeleanorvanniekerk@swstilbaai",
            "etode001" => "leonieodendaal@swstilbaai",
            "etbes007" => "ettiennebester@swstilbaai",
            "etbru002" => "henkbruyn@swstilbaai",
            "etvos003" => "alicevosloo@swstilbaai",
            "etven008" => "nardusventer@swstilbaai",
            "etwri002" => "andrewwright@swstilbaai",
            "etnep100" => "maritsanepgen@swstilbaai",
            "etbot800" => "michlenebotha@swstilbaai",
            "etlub896" => "ettiennelubbe@swstilbaai",
            "etjou020" => "lindijoubert@swstilbaai",
            "etnee001" => "corletteneethling@swstilbaai",
            "sku001" => "pieterventer@swstilbaai",
            "etsan002" => "marksanders@swstilbaai",
            "etbls001" => "wilnalubbe@swstilbaai",
            "etbre003" => "corinebreedt@swstilbaai",
            "etera001" => "hanserasmus@swstilbaai",
            "etpot003" => "chrispotgieter@swstilbaai",
            "etvan038" => "olmavandermerwe@swstilbaai",
            "etros002" => "rochelllerossouw@swstilbaai",
            "etest002" => "essieesterhuizen@swstilbaai",
            "etvan022" => "nadiavandyk@swstilbaai",
            "etbro003" => "marcellebrock@swstilbaai",
            "etvon003" => "gusvonmolendorf@swstilbaai",
            "etboo002" => "josefboom@swstilbaai",
            "etwor001" => "robworthington-smith@swstilbaai",
            "etcow001" => "lizcowan@swstilbaai",
            "etdek112" => "jeremydekock@swstilbaai",
            "etdej910" => "jacquesdejager@swstilbaai",
            "etcor100" => "antoncordier@swstilbaai",
            "etcas001" => "anitajordaangerritjordaan@swstilbaai",
            "etste100" => "drjohannsteytler@swstilbaai",
            "etroo006" => "mariusroothmanbetaler@swstilbaai",
            "etgor006" => "loodoosthuizen@swstilbaai",
            "etgor008" => "kaihasonjasmith@swstilbaai",
            "etgor009" => "roesenvredesonjasmith@swstilbaai",
            "etweg003" => "janawegewarth@swstilbaai",
            "etmos002" => "mosmarketing@swstilbaai",
            "etgor003" => "tjailasonjasmith@swstilbaai",
            "etroo004" => "mariusroothman@swstilbaai",
            "etpot500" => "paulpotgieter@swstilbaai",
            "etgoo005" => "lodewykwilhelmgoosen@swstilbaai",
            "etrei002" => "djtransportjenniferreinders@swstilbaai"
        );
        foreach($customerlist as $key =>$customer){
            $pppConnection = Pppconnection::where('name',$key)->first();
            if(isset($pppConnection->address)){
                $command = '/interface pppoe-client set user='.$customer.'password=s1mplyw1r3l3ss numbers=[find user='.$key.']';
                dd($command);
                $connection = ssh2_connect($pppConnection->address, 22);
                ssh2_auth_password($connection, 'admin', '345y1c0m5');

                $stream = ssh2_exec($connection, $command);
                dd($stream);
            }
            dd($pppConnection);
        }

    }
}
