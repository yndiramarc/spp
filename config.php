 <?php
class Buscador {
    var $host='localhost',$user='root',$pass=' ',$db='simple_invoice',$c_Servidor='Se conecto con el servidor correctamente',$i_Servidor='No se conecto con el servidor',$c_DB='Se selecciono correctamente la DB',$i_DB='No se selecciono la DB';

    function Conectar() {
        if(!@mysql_connect($this->host,$this->user,$this->pass)){
            print $this->i_Servidor;
        }else{
            if(!@mysql_select_db($this->db)){
                print $this->i_DB;
            }
        }
    }
    
    function Buscar($q) {
        $query = mysql_query("SELECT * FROM detalle_factura WHERE numero_factura LIKE '%$q%' OR id_producto LIKE '%$q%' OR id_detalle LIKE '%$q%'");
        if(mysql_num_rows($query)<=0){
            print 'No se encontro ningun resultado';
        }else{
            print '<table width="100%" border="1" cellspacing="0" cellpadding="0">
                    <tr>
                    <td>ID</td>
                    <td>Tipo</td>
                    <td>Nivel</td>
                  
                    </tr>';
            while ($row = mysql_fetch_assoc($query)){
                print '<tr>
                    <td>'.$row['numero_factura'].'</td>
                    <td>'.$row['id_producto'].'</td>
                    <td>'.$row['id_detalle'].'</td>
                  
                    </tr>';
            }
            print '</table>';
        }        
    }
}
?> 