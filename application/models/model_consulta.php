<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//@01   yomaco  19/10/15    agregando session para recuperar parametros y hacer comparacion
                            //y generara la tabla

class Model_Consulta extends CI_Model {

    var $lista = array();

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function listaSecReg(){
        $query = $this->db->query("SELECT e.idfuenteinformacion, e.nombre as nombresector, e.sigla as siglasector
        FROM formula a, formindicador b, formvarterri c, repterritorial d, fuenteinformacion e
        WHERE a.idformula = b.idformula
        AND b.idformindicador = c.idformindicador
        AND c.idrepterritorial = d.idrepterritorial
        AND d.idrepterritorial = 280
        AND c.idfuenteinformacion = e.idfuenteinformacion
        GROUP BY e.idfuenteinformacion,e.nombre
        ORDER BY e.nombre ASC;");
        return $query->result();
    }
    public function listaSecPro(){
        $query = $this->db->query("SELECT e.idfuenteinformacion, e.nombre as nombresector, e.sigla as siglasector
        FROM formula a, formindicador b, formvarterri c, repterritorial d, fuenteinformacion e
        WHERE a.idformula = b.idformula
        AND b.idformindicador = c.idformindicador
        AND c.idrepterritorial = d.idrepterritorial
        AND d.idpadre = 280
        AND c.idfuenteinformacion = e.idfuenteinformacion
        GROUP BY e.idfuenteinformacion,e.nombre
        ORDER BY e.nombre ASC;");
        return $query->result();
    }
    public function listaSecDis(){
        $query = $this->db->query("SELECT a.nombre nombreindicador, d.nombre as nombreregion, e.nombre as nombresector
        FROM formula a, formindicador b, formvarterri c, repterritorial d, fuenteinformacion e
        WHERE a.idformula = b.idformula
        AND b.idformindicador = c.idformindicador
        AND c.idrepterritorial = d.idrepterritorial
        AND d.idpadre in (281,291,311,319,337,344,353)
        AND c.idfuenteinformacion = e.idfuenteinformacion
        GROUP BY a.nombre,d.nombre, e.nombre
        ORDER BY a.nombre;");
        return $query->result();
    }

    public function buscarIndiReg(){
        if(isset($_POST['listaSector'])){
            $datosForm = $this->input->post();//recuperando datos del formulario para mostrar indicadores
            //cargar lista de sectores seleccionados
            $valor = $_POST['listaSector'];            
            //$lista = array();
            foreach ($valor as $value) {
                $lista[] = $value;                
            }
            $idsectores = implode(',', $lista);        //concatenando id de cada sector                   
            $datosComp = array('selsector'=>$idsectores); 
            $this->session->set_userdata($datosComp);
            
            $query = $this->db->query("SELECT a.idformula, a.nombre nombreindicador,e.sigla as abrsector
            FROM formula a, formindicador b, formvarterri c, repterritorial d, fuenteinformacion e
            WHERE a.idformula = b.idformula
            AND b.idformindicador = c.idformindicador
            AND c.idrepterritorial = d.idrepterritorial
            AND d.idrepterritorial = 280
            AND c.idfuenteinformacion = e.idfuenteinformacion
            AND e.idfuenteinformacion in ($idsectores)
            GROUP BY a.idformula,a.nombre,e.sigla
            ORDER BY a.nombre ASC;");
            return $query->result();

        }else{
            return FALSE;
        }
    }    
    
    public function datosTablaReg(){
        $datosForm = $this->input->post();     
        $valor = $_POST['listaIndicador'];
        
        foreach ($valor as $value) {
            $lista[] = $value;                
            $a = explode(',', $value);
            $ids[] = $a[0];            
        }      
        
        $idsindicadores = implode(',', $ids);                
        $idsectores = (String)$this->session->userdata('selsector');        
        
        
        $query = $this->db->query("SELECT 
	A .idformindicador,	b.idrepterritorial,	b.nombre as localidad,	b.codigo,f.idelemento,	C .nombre as nombreindicador,fi.sigla as abrSector,	e.idfuenteinformacion,	fi.nombre,di.valor,G .sigla,	date_part('year', e.fechadatoini) :: CHARACTER VARYING AS periodo
FROM
	formindicador A,	repterritorial b,	formula C,	formvarterri e,	indicador f,	unidadmedida G,	fuenteinformacion fi, datoindicador di
WHERE
	A .idrepterritorial = b.idrepterritorial
	AND A .idformula = C .idformula
	AND A .idformindicador = e.idformindicador
	AND C .idformula = f.idformula
	AND f.idunidadmedida = G .idunidadmedida
	AND b.idrepterritorial = A .idrepterritorial
	AND fi.idfuenteinformacion = e.idfuenteinformacion

	AND di.fechadatoini = e.fechadatoini
	AND di.idrepterritorial = b.idrepterritorial
	AND di.idfuenteinformacion = fi.idfuenteinformacion
	AND di.idvariables = e.idvariables

	AND fi.idfuenteinformacion IN ($idsectores)
	AND f.idelemento in ($idsindicadores)
	AND b.idrepterritorial = 280
	AND e.fechadatoini BETWEEN '2005-01-01' AND '2015-01-01'
	GROUP BY 	f.idelemento,di.valor,fi.nombre,	A .idformindicador,	b.idrepterritorial,	b.nombre,	b.codigo,	C .nombre,fi.sigla,	e.idfuenteinformacion,	C .formula,
	A .idrepterritorial,	e.idfuenteinformacion,	e.idmetodocaptura,	G .sigla,	e.fechadatoini
	ORDER BY A.idformindicador,e.fechadatoini;");                
        return $query->result();
    }






//_-------------Anterior
    public function listaSector() {        
        $query = $this->db->query("
            SELECT f.idfuenteinformacion, rt.idrepterritorial,f.nombre as nombresector, f.idtipofuenteinfo,f.sigla, rt.nombre
            FROM repterritorial rt 
			INNER JOIN elemento el on rt.idrepterritorial = el.idrepterritorial and rt.codigo = '030000'			
			INNER JOIN elemento_has_fuenteinfo elf on elf.idelemento = el.idelemento
			INNER JOIN fuenteinformacion f on f.idfuenteinformacion = elf.idfuenteinformacion and f.idtipofuenteinfo = 1
            GROUP BY f.idfuenteinformacion, rt.nombre,rt.idrepterritorial
            ORDER BY f.idfuenteinformacion;
                 ");
        return $query->result();        
    } 
    public function listIndiSec(){
        
        if(isset($_POST['listaSector'])){
            $datosForm = $this->input->post();//recuperando datos del formulario para mostrar indicadores
            //cargar lista de sectores seleccionados
            $valor = $_POST['listaSector'];            
            //$lista = array();
            foreach ($valor as $value) {
                $lista[] = $value;                
            }
            $idsectores = implode(',', $lista);        //concatenando id de cada sector                   
            $datosComp = array('selsector'=>$idsectores,'lissector'=>$lista);                     
            $this->session->set_userdata($datosComp);            

            $query = $this->db->query("SELECT f.idelemento,c.nombre,fi.idfuenteinformacion,fi.sigla,g.sigla as unimedida
	FROM formindicador a, repterritorial b, formula c ,formvarterri e,indicador f, unidadmedida g, fuenteinformacion fi
	WHERE a.idrepterritorial = b.idrepterritorial	
	AND a.idformula = c.idformula
	AND a.idformindicador = e.idformindicador
	AND c.idformula = f.idformula
	AND f.idunidadmedida = g.idunidadmedida
	and b.idrepterritorial = a.idrepterritorial
	and fi.idfuenteinformacion = e.idfuenteinformacion		
	AND fi.idfuenteinformacion IN ($idsectores) --159,151,64
	GROUP BY f.idelemento,c.nombre,fi.idfuenteinformacion,fi.sigla,g.sigla
	ORDER BY f.idelemento;");                      
                return $query->result();

        }else{
            return FALSE;
        }
    }    
    public function mtablaReg(){
        
        $datosForm = $this->input->post();
        $fi_dia = $datosForm['fi_dia'];
        $fi_mes = $datosForm['fi_mes'];
        $fi_anio = $datosForm['fi_anio'];
        $fechaInicial = $fi_anio.'-'.$fi_mes.'-'.$fi_dia;
        
        // recuperando fecha final
        $ff_dia = $datosForm['ff_dia'];
        $ff_mes = $datosForm['ff_mes'];
        $ff_anio = $datosForm['ff_anio'];
        $fechaFinal = $ff_anio.'-'.$ff_mes.'-'.$ff_dia;
        
        $valor = $_POST['listaIndicador'];            
        
        //$lista = array();
        foreach ($valor as $value) {
            $lista[] = $value;                
            $a = explode(',', $value);
            $ids[] = $a[0];
            //$abrsector[] = $a[1];
            $nomindi[] = $a[2];
            $nombres[] = $a[3];
            $indisec[] = $a[1].','.$a[2];
            $unimedida[] = $a[4];
        }
        //print_r($ids);
        //echo '<br>';
        //print_r($indisec);
        //exit;
        
        $idsindicadores = implode(',', $ids);                
        $idsectores = (String)$this->session->userdata('selsector');
        $datosComp = array('lisindi'=>$lista,'listnombre'=>$nombres,'indisec'=>$indisec,'nombreindi'=>$nomindi,'unimedida'=>$unimedida);
        $this->session->set_userdata($datosComp);
        
        
        
        
        
        $query = $this->db->query("SELECT * FROM crosstab(
$$ SELECT C.nombre,date_part('year', e.fechadatoini) :: CHARACTER VARYING AS periodo, di.valor
FROM
	formindicador A,	repterritorial b,	formula C,	formvarterri e,	indicador f,	unidadmedida G,	fuenteinformacion fi, datoindicador di
WHERE
	A .idrepterritorial = b.idrepterritorial
	AND A .idformula = C .idformula
	AND A .idformindicador = e.idformindicador
	AND C .idformula = f.idformula
	AND f.idunidadmedida = G .idunidadmedida
	AND b.idrepterritorial = A .idrepterritorial
	AND fi.idfuenteinformacion = e.idfuenteinformacion

	AND di.fechadatoini = e.fechadatoini
	AND di.idrepterritorial = b.idrepterritorial
	AND di.idfuenteinformacion = fi.idfuenteinformacion
	AND di.idvariables = e.idvariables

	AND fi.idfuenteinformacion IN ($idsectores)
	AND f.idelemento in ($idsindicadores)
	AND b.idrepterritorial = 280

	AND e.fechadatoini BETWEEN '2005-01-01' AND '2015-01-01'
	GROUP BY C.nombre,e.fechadatoini, di.valor,fi.sigla
	ORDER BY 1 $$,
	$$ SELECT c.anio:: CHARACTER VARYING AS periodo
 FROM generate_series(2005, 2015) AS c(anio) $$
)AS (indicador text, \"a2005\" FLOAT,\"a2006\" FLOAT,\"a2007\" FLOAT,\"a2008\" FLOAT,\"a2009\" FLOAT,\"a2010\" FLOAT,\"a2011\" FLOAT,\"a2012\" FLOAT, \"a2013\" FLOAT, \"a2014\" FLOAT, \"a2015\" FLOAT);");                
        return $query->result();
    }
    
    public function mtablaPro(){
        $query = $this->db->query("");                
        return $query->result();
    }
    public function msiglaSector(){
        $idsectores = (String)$this->session->userdata('selsector');
        $query = $this->db->query("SELECT idfuenteinformacion,nombre,sigla,url 
        FROM fuenteinformacion where idfuenteinformacion in ($idsectores);");
        return $query->result();
    }
    public function mselIndicador(){        
    }
}