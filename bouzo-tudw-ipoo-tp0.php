<?php

function precarga(){
    $vinos=[
        "malbec"=>[
            ["cantidad"=>"15","anio"=>"2000","precio"=>"1000"],
            ["cantidad"=>"2","anio"=>"1950","precio"=>"8000"],
            ["cantidad"=>"18","anio"=>"2010","precio"=>"500"],
            ["cantidad"=>"4","anio"=>"1995","precio"=>"2000"]
        ],
        "cavernet"=>[
            ["cantidad"=>"15","anio"=>"1980","precio"=>"3000"],
            ["cantidad"=>"2","anio"=>"1970","precio"=>"13000"],
            ["cantidad"=>"5","anio"=>"2021","precio"=>"100"]
        ],
        "merlot"=>[
            ["cantidad"=>"3","anio"=>"2001","precio"=>"800"],
            ["cantidad"=>"10","anio"=>"1990","precio"=>"1500"]
        ],
        "pinot"=>[
            ["cantidad"=>"1","anio"=>"1960","precio"=>"15000"]
        ]
    ];
    return $vinos;
};

function carga($vinos){
    if (empty($vinos)) {
        cartel("no hay lista de vinos para mostrar");
    } else {
        cartel("lista de vinos actual");
    }
    $variedad=array_keys($vinos);
    foreach ($variedad as $tipo) {
        echo $tipo."\n";
    }

    cartel("ingrese que variedad desea agregar");
    $variedad=trim(fgets(STDIN));

    cartel("ingrese que cantidad");
    $cantidad=trim(fgets(STDIN));

    cartel("ingrese que anio");
    $anio=trim(fgets(STDIN));

    cartel("ingrese el precio");
    $precio=trim(fgets(STDIN));

    cartel("datos a cargar");
    echo "variedad :".$variedad."\n";
    echo "anio :".$anio."\n";
    echo "precio :".$precio."\n";

    if (array_key_exists($variedad, $vinos)) {
        array_push($vinos[$variedad],["cantidad"=>$cantidad,"anio"=>$anio,"precio"=>$precio]);
    } else {
        $vinos[$variedad]=[["cantidad"=>$cantidad,"anio"=>$anio,"precio"=>$precio]];
    };
    return $vinos;
};

function promedio(array $vinos){
    $total=[];
    foreach ($vinos as $variedad => $tipo) {
        $total[$variedad]=["cantidad"=>0,"precio"=>0];
        foreach ($tipo as $subtotal) {
            $total[$variedad]["cantidad"]=$total[$variedad]["cantidad"]+$subtotal["cantidad"];
            $total[$variedad]["precio"]=$total[$variedad]["precio"]+$subtotal["precio"]*$subtotal["cantidad"];
        };
        $total[$variedad]["precio"]=$total[$variedad]["precio"]/$total[$variedad]["cantidad"];
    };
    return ($total);
};

function cartel(string $texto){
    $texto=strtoupper($texto);
    echo str_repeat("-",60)."\n";
    while (strlen($texto)>=55){
        echo "| ".substr($texto, 0, 55)."  |\n";
        $texto=substr($texto,55,strlen($texto)-55);
    };
    echo "| ".$texto. str_repeat(" ",55-strlen($texto))."  |\n";
    echo str_repeat("-",60)."\n";
};

function main(){
    $lista=[];
    do {
        cartel("ingrese que desea hacer");
        echo "1 - cargar vinos\n";
        echo "2 - mostrar promedios\n";
        echo "7 - pre-carga vinos\n";
        echo "8 - print_r vinos\n";
        echo "9 - eliminar lista de vinos\n";
        echo "0 - salir\n";
        $texto=trim(fgets(STDIN));
        switch ($texto){
            case "1":
                $lista=carga($lista);
                break;
            case "2":
                if (empty($lista)) {
                    cartel("no hay promedios para mostrar");
                } else {
                    $total=promedio($lista);
                    cartel("listado de cantidades de botellas y promedio de precios por variedad");
                    foreach ($total as $variedad => $subtotal) {
                        echo "cantidad de botellas de ".$variedad." : ".$subtotal["cantidad"]."\n";
                        echo "promedio de precios de ".$variedad." : $".round($subtotal["precio"],2)."\n";
                        echo "\n";
                    };
                };
                break;
            case "7":
                $lista=precarga();
                cartel("vinos pre cargados");
                break;
            case "8":
                cartel("print_r vinos");
                print_r($lista);
                break;
            case "9":
                $lista=[];
                cartel("lista de vinos eliminada");
                break;
            case "0":
                cartel("salir");
                break;
            default:
                cartel("error - valor incorrecto - ingrese nuevamente");
                break;
        };
    } while ($texto != "0");
};

main();

?>
