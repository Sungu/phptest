<?php
header("Content-Type:application/json");
  
// // 1. 데이터베이스에서 데이터를 가져옴
$conn = pg_connect('host=heart5.kaist.ac.kr dbname=codatest_mjkwon port=5432 user=bisler password=bislaprom3 connect_timeout=5') or die('Could not connect: '.pg_last_error());

$node_list = $_POST['node_list'];

for($i=1;$i <= count($node_list);$i++){
    ${"entity".$i} = $node_list[$i-1];
}

for($i=1;$i <= count($node_list);$i++){
    if(substr(${"entity".$i},0,2)=="GE"){
        ${"query".$i} = "SELECT * FROM gene where geneid='${"entity".$i}';";
    }
    else if(substr(${"entity".$i},0,2)=="CP"){
        ${"query".$i} = "SELECT * FROM compound where compid='${"entity".$i}';";
    }
    else if(substr(${"entity".$i},0,2)=="PH"){
        ${"query".$i} = "SELECT * FROM phenotype where phenid='${"entity".$i}';";
    }
    else if(substr(${"entity".$i},0,2)=="BP"){
        ${"query".$i} = "SELECT * FROM biologicalprocess where biologicalprocessid='${"entity".$i}';";
    }
    else if(substr(${"entity".$i},0,2)=="MF"){
        ${"query".$i} = "SELECT * FROM molecularfunction where molecularfunctionid='${"entity".$i}';";
    }
    else if(substr(${"entity".$i},0,2)=="CC"){
        ${"query".$i} = "SELECT * FROM cellcompartment where cellcompartmentid='${"entity".$i}';";
    }
    else if(substr(${"entity".$i},0,2)=="CE"){
        ${"query".$i} = "SELECT * FROM cell where cellid='${"entity".$i}';";
    }
    else if(substr(${"entity".$i},0,2)=="BD"){
        ${"query".$i} = "SELECT * FROM organ where organid='${"entity".$i}';";
    }
    else if(substr(${"entity".$i},0,2)=="OG"){
        ${"query".$i} = "SELECT * FROM organism where organismid='${"entity".$i}';";
    }
    else if(substr(${"entity".$i},0,2)=="TS"){
        ${"query".$i} = "SELECT * FROM tissue where tissueid='${"entity".$i}';";
    }
    else{
        echo "An error occurred.\n";
        exit;
    }
}

for($i=1;$i <= count($node_list);$i++){
    ${"result".$i} = pg_query($conn, ${"query".$i});
    ${"data".$i} = array();
    while ($row = pg_fetch_row(${"result".$i})) {
        
        if(substr(${"entity".$i},0,2)=="GE"){
            ${"data".$i}[] = array('geneid'=> $row[0],'entrezid'=> $row[1],'a_ensemblid'=> $row[2],'a_biogridid'=> $row[3],'a_pharmgkbid'=> $row[4],'symbol'=> $row[5],
                        'a_synonym'=> $row[6],'ncbitaxid'=> $row[7],'a_uniprotid'=> $row[8],'a_ecnumber'=> $row[9],'a_goid'=> $row[10]);
        }
        else if(substr(${"entity".$i},0,2)=="CP"){
            ${"data".$i}[] = array('compid'=> $row[0],'a_inchikey'=> $row[1],'a_inchi'=> $row[2],'stitchsid'=> $row[3],'stitchfid'=> $row[4],'name'=> $row[5],
                        'a_synonym'=> $row[6],'smiles'=> $row[7],'a_pubchemid'=> $row[8],'a_chemblid'=> $row[9],'a_casid'=> $row[10],'a_bindingdbid'=> $row[11]
                        ,'a_keggid'=> $row[12],'a_drugbankid'=> $row[13],'formula'=> $row[14],'weight'=> $row[15],'a_atccode'=> $row[16]);
        }
        else if(substr(${"entity".$i},0,2)=="PH"){
            ${"data".$i}[] = array('phenid'=> $row[0],'umlsid'=> $row[1],'a_meshid'=> $row[2],'name'=> $row[3],'a_synonym'=> $row[4],'a_semantictype'=> $row[5]);
        }
        else if(substr(${"entity".$i},0,2)=="BP"){
            ${"data".$i}[] = array('biologicalprocessid'=> $row[0],'goid'=> $row[1],'name'=> $row[2],'a_synonym'=> $row[3]);
        }
        else if(substr(${"entity".$i},0,2)=="MF"){
            ${"data".$i}[] = array('molecularfunctionid'=> $row[0],'goid'=> $row[1],'name'=> $row[2],'a_synonym'=> $row[3]);
        }
        else if(substr(${"entity".$i},0,2)=="CC"){
            ${"data".$i}[] = array('cellcompartmentid'=> $row[0],'goid'=> $row[1],'name'=> $row[2],'a_synonym'=> $row[3]);
        }
        else if(substr(${"entity".$i},0,2)=="CE"){
            ${"data".$i}[] = array('cellid'=> $row[0],'meshid'=> $row[1],'name'=> $row[2],'a_synonym'=> $row[3]);
        }
        else if(substr(${"entity".$i},0,2)=="BD"){
            ${"data".$i}[] = array('organid'=> $row[0],'meshid'=> $row[1],'name'=> $row[2],'a_synonym'=> $row[3]);
        }
        else if(substr(${"entity".$i},0,2)=="OG"){
            ${"data".$i}[] = array('organid'=> $row[0],'meshid'=> $row[1],'name'=> $row[2],'a_synonym'=> $row[3]);
        }
        else if(substr(${"entity".$i},0,2)=="TS"){
            ${"data".$i}[] = array('tissueid'=> $row[0],'meshid'=> $row[1],'name'=> $row[2],'a_synonym'=> $row[3]);
        }
        else{
            echo "An error occurred.\n";
            exit;
        }
        
    }
}

$data_all=array();
for($i=1;$i <= count($node_list);$i++){
    $data_all[${"entity".$i}] = ${"data".$i};
}

echo json_encode($data_all);
// print_r (json_encode($data_all));
// $fp = fopen('dic.json', 'w');
// fwrite($fp, json_encode($data));
// fclose($fp);