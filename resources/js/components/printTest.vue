<template>
<div class="container">

 <table border="1" cellpadding="3" ref="printTable">
 <tbody><tr>
 <th>First Name</th>
 <th>Last Name</th>
 <th>Points</th>
 </tr>
 <tr>
 <td>Jill</td>
 <td>Smith</td>
 <td>50</td>
 </tr>
 <tr>
 <td>Eve</td>
 <td>Jackson</td>
 <td>94</td>
 </tr>
 <tr>
 <td>John</td>
 <td>Doe</td>
 <td>80</td>
 </tr>
 <tr>
 <td>Adam</td>
 <td>Johnson</td>
 <td>67</td>
 </tr>
 </tbody></table>
 <button @click="printData">Print me</button>
</div>

</template>
<script>
export default {
  data() {
    return {

    };


  },

  methods: {
 printData()
 {
 var divToPrint= this.$refs.printTable
 newWin= window.open("");
 newWin.document.write(divToPrint.outerHTML);
 newWin.print();
 newWin.close();
 }
}
,

  created() {



  }
};
</script>


