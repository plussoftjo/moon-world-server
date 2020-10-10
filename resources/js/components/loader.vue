<template>
    <div class="loader_main">
        <div class="loader"></div>
    </div>
</template>
<script>
export default {
    
}
</script>
<style>
.loader_main {position: absolute; top: 0px; left:0px; width:100%; height: 100%; z-index: 1000; padding-left:45%;padding-top: 25%; background-color: rgba(0,0,0,0.3);}
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 100px;
  height: 100px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>