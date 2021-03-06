<?php
require_once('libs/smarty-3.1.39/libs/Smarty.class.php');

class SeriesView{


    function __construct(){}

    function DisplaySeriesGen($series,$generos,$user){
        $smarty=new Smarty();
        $smarty->assign('titulo','Top Series');
        $smarty->assign('tituloNav','Generos');
        $smarty->assign('lista_series',$series);
        $smarty->assign('lista_generos',$generos);
        $smarty->assign('user',$user);
        $smarty->display('templates/ver_series.tpl');
    }

    function infoSerie($serie,$user){
        $smarty=new Smarty();
        $smarty->assign('titulo','informacion de la serie');
        $smarty->assign('serie',$serie);
        $smarty->assign('user',$user);
        $smarty->display('templates/serie.tpl');
    }

    function showSeries($series){
        $smarty=new Smarty();
        $smarty->assign('titulo','Series Disponibles');
        $smarty->assign('lista',$series);
        $smarty->display('templates/listaSeries.tpl');
    }
    public function DisplaySeries($series,$generos,$user){
        $smarty = new Smarty();
        $smarty->assign('titulo',"Mostrar Series");
        $smarty->assign('lista_series',$series);
        $smarty->assign('lista_generos',$generos);
        $smarty->assign('user',$user);
        $smarty->display('templates/modificar.tpl');
    }
}
