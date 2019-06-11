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
		    <tr v-for="row in sortedinfo">
		      <td>{{row.orderId}}</td>
		      <td>{{row.region}}</td>
		      <td>{{row.country}}</td>
		      <td>{{row.itemtype}}</td>
		      <td>{{row.price}}</td>
		    </tr>
		  </tbody>
	  </table>

	  debug: sort={{currentSort}}, dir={{currentSortDir}}
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
	  },
	  methods:{
	    sort:function(s) {
	      //if s == current sort, reverse
	      if(s === this.currentSort) {
	        this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
	      }
	      this.currentSort = s;
	    },
	    nextPage:function() {
	      if((this.currentPage*this.pageSize) < this.info.length) this.currentPage++;
	    },
	    prevPage:function() {
	      if(this.currentPage > 1) this.currentPage--;
	    }

  	  },
	  computed:{
	    sortedinfo:function() {
	      return this.info.sort((a,b) => {
	        let modifier = 1;
	        if(this.currentSortDir === 'desc') modifier = -1;
	        if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
	        if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
	        return 0;
	      }).filter((row, index) => {
	        let start = (this.currentPage-1)*this.pageSize;
	        let end = this.currentPage*this.pageSize;
	        if(index >= start && index < end) return true;
	      });
	    }
	  }
	})
//   new Vue({
//   el: '#app',
//   data () {
//     return {
//       info: null
//     }
//   },
//   mounted () {
//     axios
//       .get('jsonapi.php')
//       .then(response => (this.info = response.data))
//   }
//   })

//   new Vue({
//   el:'#app',
//   data:{
//     cats:[],
//     currentSort:'name',
//     currentSortDir:'asc'
//   },
//   created:function() {
//     fetch('https://api.myjson.com/bins/s9lux')
//     .then(res => res.json())
//     .then(res => {
//       this.cats = res;
//     })
//   },
//   methods:{
//     sort:function(s) {
//       //if s == current sort, reverse
//       if(s === this.currentSort) {
//         this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
//       }
//       this.currentSort = s;
//     }
//   },
//   computed:{
//     sortedCats:function() {
//       return this.cats.sort((a,b) => {
//         let modifier = 1;
//         if(this.currentSortDir === 'desc') modifier = -1;
//         if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
//         if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
//         return 0;
//       });
//     }
//   }
// })

  </script>

</body>
</html>

