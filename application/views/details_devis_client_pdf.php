<style>
    *{
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    th {
        text-align: left;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2
    }
</style>

<div class="titre">

    <h1>DEVIS</h1>
    <div class="text-center">
		 		<!-- <img style="width: 200px; border-radius: 10px" src="<?=base_url('assets/images/logo-icon2.png')?>" alt="logo icon"> -->
	</div>
</div>

<br></br>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Travaux</th>
            <th scope="col">Unite</th>
            <th scope="col">Quantite</th>
            <th scope="col">Prix_unitaire</th>
            <th scope="col">Prix Total</th>
        </tr>
    </thead>
    <>
        <?php foreach($details as $dem): ?>
            <tr>
                <td><?php echo $dem->designation_travaux; ?></td>
                <td><?php echo $dem->unite_travaux; ?></td>
                <td><?php echo $dem->quantite_detail_devis; ?></td>
                <td><?php echo number_format($dem->prix_unitaire_detail_devis, 2).' Ar'; ?></td>
                <td><?php echo number_format($dem->prix_total_detail_devis, 2).' Ar'; ?></td>
            </tr>

            <br></br>
            

           
        <?php endforeach; ?>
        <p>Total avec finition : <?php echo number_format($dem->nouveau_prix_total_devis, 2).' Ar'; ?></p>

    </tbody>
</table>


<!-- <h2 class="float-right" style="margin-right:100px; margin-top:50px">
                <p>Total : <small class="text"><?php echo number_format($dem->nouveau_prix_total_devis,2). 'Ar';?> </small></p>
</h2> -->



