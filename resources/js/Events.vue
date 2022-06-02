<template>
    <div>
        <div v-for="event in events" :key="event.id">
            
            <a :href="event.link" >
            <div class="card">
                    <div  iv class="icon"><i class="hicon dashicons dashicons-heart"></i></div>

                <div class="card-image" :style="{backgroundImage:`url(${event.thumbnail})`}"></div>
                <div class="card-text">
                    <h2>{{ event.title }}</h2>
                    <h5>{{ event.date }}</h5>
                </div>
                <div class="card-stats">
                    <div class="stat">Author - {{ event.author }}
                        <span class="type"><i class="dashicons dashicons-text-page"></i> Post Type- {{ event.type }}</span>
                    </div>
                </div>
            </div>
            </a>
         </div>   
    </div>
    
</template>
<script>
import axios from 'axios';
export default {
    name:"admin-events",
    props:["app"],
    data(){
        return {
            events: [],
        }
    },
    mounted(){
        this.getAll();
    },
    methods:{
        getAll(){
            axios.get(`http://localhost:80/wp-cis-test/wp-json/cis-test/v2/events/`)
                .then(response => {
                    this.events = response.data;
                }).catch((e)=>{
                    console.log(e);
                })
        }
    },
}
</script>

<style scoped>
.card {
  display: grid;
  grid-template-columns: 300px;
  grid-template-rows: 210px 150px 60px;
  grid-template-areas: "image" "text" "stats";
  border-radius: 18px;
  background: white;
  box-shadow: 3px 3px 10px rgba(143, 143, 143, 0.9);
  text-align: center;
  transition: 0.5s ease;
  cursor: pointer;
  margin:30px;
  margin-left: 50px;
  width: 300px;
  float: left;
}
@media screen and (max-width: 600px) {
.card {
  display: grid;
  grid-template-columns: 300px;
  grid-template-rows: 210px 150px 60px;
  grid-template-areas: "image" "text" "stats";
  border-radius: 18px;
  background: white;
  box-shadow: 3px 3px 10px rgba(143, 143, 143, 0.9);
  text-align: center;
  transition: 0.5s ease;
  cursor: pointer;
  margin:30px;
  margin-left: 20%;
  width: 300px;
  float: left;
}
}
.icon {
   margin: 180px 230px;
   width: 100%;
   height: 60px;
   max-width:60px;
   background: linear-gradient(90deg, #ffffff 0%, #ffffff 40%, rgb(221 221 221) 60%);
   border-radius: 100%;
   display: flex;
   justify-content: center;
   align-items: center;
   color: rgb(145, 145, 145);
   transition: all 0.8s ease;
   background-position: 0px;
   background-size: 200px;
   border: solid 1px #dbdae3 ;
   position: absolute;
}
.card:hover .icon {
   background-position: -120px;
   transition: all 0.3s ease;
}
.card:hover .icon i {
   background: linear-gradient(90deg, #FF7E7E, #FF4848);
   -webkit-background-clip: text;
	-webkit-text-fill-color: transparent;
   opacity: 1;
   transition: all 0.3s ease;
}
.card-image {
  grid-area: image;
  background-color: #ffffff;
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  background-size: cover;
}
.card-text {
  grid-area: text;
  margin: 25px;
  text-align: left;
  overflow: hidden;
}
.card-text h2 {
  margin-top:0px;
  font-size:22px;
  color: #39364f;
  font-weight:bold;
}
.card-text h5 {
  margin-top:0px;
  font-size:16px;
  color: #d1410c;
  font-weight:none;
}
.card-stats {
  grid-area: stats;
  grid-template-columns: 1fr 1fr 1fr;
  grid-template-rows: 1fr;
  border-bottom-left-radius: 18px;
  border-bottom-right-radius: 18px;
  background-color: #437dd3;
}
.card-stats .stat {
  padding-left:10px;
  display: flex;
  flex-direction: column;
  color: #ffffff;
  text-align: left;
  font-size: 14px;
  margin-left: 20px;
  float: left;
  font-weight:none;
}
.card:hover {
  transform: scale(1.1);
  box-shadow: 5px 5px 15px rgba(136, 136, 136, 0.9);
}
</style>