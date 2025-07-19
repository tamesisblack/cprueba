<style>
    html {
        min-height: 100%;
        position: relative;
    }

    body{
        font-family: Arial, Helvetica;
        font-size: 11px;
        margin-bottom: 20px;
    }

     @page { margin: 140px 50px; }
        #header { position: fixed; left: 0px; top: -110px; right: 0px; height: 1300px;  text-align: center; }
        #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 100px; }
        #footer .page:after { }
    
    .container{
        margin: 0 auto;
        position: relative;
        margin-bottom: 15px;
    }

    table{
        border-collapse: collapse;
    }



    table, td, th, tr {
        border: 0px solid black;
    }
    th{
        text-align: left;
    }
	tr{
      border-top-width: 1px;
    }

    .bordes{
        background-color: #e3e4e5;
        border-top: 2px solid;
        border-bottom: 2px solid;
        padding-bottom: 5px;
        padding-top: 5px;
    }

    .bordes2px{
        border-top: 1px solid;
        border-bottom: 1px solid;
    }

    .sinbordes{
        border: 0px solid !important;
    }

    .text_footer {
        background-color: white;
        position: absolute;
        bottom: 0;
        width: 98%;
        height: 20px;
        color: black;
        text-align: center;
    }
	
    .full-table{
        width: 100%;
    }
    .left, .right{
            width: 48%;
     }
     .left{
        float: left;
     }

     .right{
        float: right;
     }
     .t-float{
        height: 90px;
     }
     .left>table, .right>table{
        width: 100%;
     }
     .row{
        margin-bottom: 15px;
     }
    tbody:before, tbody:after{ 
        display: none; 
    }
    .total{
        text-align: right;
        margin-right: 4px;
    }
    .border-none{
        border: none;
    } 
    .border-left{
        width: 50%;
        text-align: center;
        border-left: solid 8px red; 
    }
	 
 
</style>
