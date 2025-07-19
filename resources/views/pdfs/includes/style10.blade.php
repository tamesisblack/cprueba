<style>
    body{
        font-family: Arial, Helvetica;
        font-size: 10px;
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
        border: 1px solid black;
    }
    th{
        text-align: left;
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