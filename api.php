<?php
// require_once 'classes/api.php';
// $getdata = new Api;
// header('Content-Type:application/json');
// echo $getdata->select();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Page Title</title>
<link rel="stylesheet" type="text/css" href="assets/css/main.css">
<!-- development version, includes helpful console warnings -->
<!-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->
<script type="text/javascript" src = "assets/js/vue.js" ></script>
  <!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>

  <div class="container">
    <div id="app">
      <table id="firstTable">
		  <thead>
		    <tr>
		      <th @click="sort('orderId')">Order ID</th>
		      <th @click="sort('region')">Region</th>
		      <th @click="sort('country')">Country</th>
		      <th @click="sort('itemtype')">Itemtype</th>
		      <th @click="sort('price')">Price</th>
		    </tr>
		  </thead>
		  <tbody>
		    <tr v-for="row in info">
		      <td>{{row.orderId}}</td>
		      <td>{{row.region}}</td>
		      <td>{{row.country}}</td>
		      <td>{{row.itemtype}}</td>
		      <td>{{row.price}}</td>
		    </tr>
		  </tbody>
	  </table>

    </div>
  </div>

  <script>

  	const app = new Vue({
	  el:'#app',
	  data:{
	    info:[],
	    currentSort:'orderId',
  		currentSortDir:'asc',
  		pageSize:50,
    	currentPage:1
	  },
	  created:function() {
	    fetch('jsonapi.php')
	    .then(res => res.json())
	    .then(res => {
	      this.info = res;
	    })
	  }
	})
  </script>

</body>
</html>

