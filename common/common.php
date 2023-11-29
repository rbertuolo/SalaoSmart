<?

function EntoBr($data)
{
    $arr = explode('-', $data);
    return $arr[2].'/'.$arr[1].'/'.$arr[0];
}

function BrToEn($data)
{
    //2023-11-29
    $newDate = date("Y-m-d", strtotime($data));
    return $newDate;
}

function converteTipo($filtro)
{
    if($filtro == 'cliente') $tipo = 1; 
    else if($filtro == 'profissionais') $tipo = 3; 
    else if($filtro == 'adm') $tipo = 2;
    else $tipo = '';

    return $tipo;
}

function mesByExtenso($mes)
{
    if(($mes == "01") || ($mes == "1"))
    {
        $extenso = "Janeiro";
    }
    else if(($mes == "02") || ($mes == "2"))
    {
        $extenso = "Fevereiro";
    }
    else if(($mes == "03") || ($mes == "3"))
    {
        $extenso = "Março";
    }
    else if(($mes == "04") || ($mes == "4"))
    {
        $extenso = "Abril";
    }
    else if(($mes == "05") || ($mes == "5"))
    {
        $extenso = "Maio";
    }
    else if(($mes == "06") || ($mes == "6"))
    {
        $extenso = "Junho";
    }
    else if(($mes == "07") || ($mes == "7"))
    {
        $extenso = "Julho";
    }
    else if(($mes == "08") || ($mes == "8"))
    {
        $extenso = "Agosto";
    }
    else if(($mes == "09") || ($mes == "9"))
    {
        $extenso = "Setembro";
    }
    else if($mes == "10")
    {
        $extenso = "Outubro";
    }
    else if($mes == "11")
    {
        $extenso = "Novembro";
    }
    else
    {
        $extenso = "Dezembro";
    }

    return $extenso;
}

?>