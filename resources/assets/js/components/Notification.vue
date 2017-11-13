<template>

    <li>
          <a title="Notifications" @click="markAsRead"><span uk-icon="icon:bell;ratio:1.3"></span>
            <span class="uk-badge" v-if="notificationCount > 0">{{notificationCount}}</span>
          </a>
          <div uk-dropdown="mode: click; pos: bottom-center;">
              <div class="uk-width-medium ">
                      <ul class="uk-nav uk-dropdown-nav">

                            <li class="uk-margin uk-align-center" v-for="note in notifications">
                                    
                                <div v-if="(note.type) == 'App\\Notifications\\PostComment'" >
                                    <a :href="'/blog/'+ (note.data.post.slug)"><img style="height:20px;width:20px;margin-right:5px;" :src="'/images/user-profile/' + note.data.user.avatar"> {{ note.data.user.name }} Commented on Your Story <img style="height:20px;width:20px;margin-left:5px;" :src="'/images/blog/'+note.data.post.image"> . 
                                    </a>
                                    <div class="uk-text-muted">{{note.created_at}}</div>
                                </div>
                                    
                                <div v-if="(note.type) == 'App\\Notifications\\PostLike'" >
                                    <a :href="'/blog/'+ (note.data.post.slug)"><img style="height:20px;width:20px;margin-right:5px;" :src="'/images/user-profile/' + note.data.user.avatar"> {{ note.data.user.name }} Likes Your Story <img style="height:20px;width:20px;margin-left:5px;" :src="'/images/blog/'+note.data.post.image"> . 
                                    </a>
                                    <div class="uk-text-muted">{{note.created_at}}</div>
                                </div>
                                    
                                <div v-if="(note.type) == 'App\\Notifications\\PostBookmark'">
                                    <a :href="'/blog/'+ (note.data.post.slug)" ><img style="height:20px;width:20px;margin-right:5px;" :src="'/images/user-profile/' + note.data.user.avatar"> {{ note.data.user.name }} Saved Your Story <img style="height:20px;width:20px;margin-left:5px;" :src="'/images/blog/'+note.data.post.image"> . 
                                    </a>
                                    <div class="uk-text-muted">{{note.created_at}}</div>
                                </div>

                                <hr>
                            </li>

                      </ul>
              </div>
          </div>
      </li>

</template>


<script>

	export default {
        props: ['notification','userid'],

        data : function() {
            return {
                notifications : this.notification,
                user : this.userid,
                count : 0
            }
        },

        mounted() {

            Echo.private('App.User.' + this.user)
                .notification((notification) => {
                    console.log(notification);
                    this.notifications.push(notification);
                });

        },
        methods : {

            markAsRead : function() {

                axios.get('/markAsRead');
            }
            
        },

        computed : {
            notificationCount : function() {
                for(var i=0 ; i<this.notifications.length; i++)
                {
                    if(this.notifications[i].read_at == null)
                    {
                        this.count++;
                    }
                }
                return this.count;
            }
        }

    }

</script>