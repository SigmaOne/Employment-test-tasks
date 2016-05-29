# Predefined entties
City.create([{ name: 'St.Petersburg' }, { name: 'Moscow'}, { name: 'Krasnodar' }])

# Add users
users = User.create([{ name: 'Admin' }, { name: 'Nikita' }, { name: 'Jane' }, { name: 'Mike' }])

# Create events
birthday_event = Event.create(
                   name: "Mike's brthday",
                   description: "Heyy, i so do like Mike, he's my best friend, so, let's prepare a surptise for him.
                                He will be so happy, we need balloons, little pancakes which he loves and photocamera
                                Who can help me with that, guys? My home is free from my parents for this weekend, so
                                we can celebrate it there! Write down some comments if you think this is a great idea
                                and you can help me with that!",
                   start_date: Date.new,
                   end_date: Date.new,
                   city: City.second,
                   address: 'Krasnaya 5' )
happy_new_year_event = Event.create(
                         name: 'Happy new year',
                         description: "Well, every year humans celebrate this event. It's kinda weird, but it's fin!
                                      So, lt's group up somewhere and celebrate!",
                         start_date: Date.new,
                         end_date: Date.new,
                         city: City.first,
                         address: 'Nevsky Prospect 4' )

# Add discussions to events
birthday_event.discussions.create(topic: "What's your present?")
birthday_event.discussions.create(topic: 'With which you can help me?')
happy_new_year_event.discussions.create(topic: "What's up with presents?")
happy_new_year_event.discussions.create(topic: 'Is it cold in this season?')

# Add some comments to discussions

d2 = Discussion.second
d2.comments.create(user: users[0], content: 'first!!! ahauhauhau')
d2.comments.create(user: users[1], content: 'Crap')

d = Discussion.first
d.comments.create(user: users[0], content: "first!!! ahauhauhau. Btw i'll get him new soccer ball")
d.comments.create(user: users[1], content: "Crap,  wanted to give him ball :D I'll get Manchkin game then. We can play it this day btw!")
d.comments.create(user: users[2], content: "I know that he loves Dota 2, so, i'll give him brand new courier!")
d.comments.create(user: users[3], content: 'sup')

# Add filters to first user
users[0].saved_filters.create(name: 'Kitten Filter', event_name: 'Kittens')
users[0].saved_filters.create(name: 'Date Filter', start_date: Date.new, end_date: Date.new)
