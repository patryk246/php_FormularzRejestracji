<?php
// test metod show(), set(), get()
 include 'index.php';
 $user1 = new User ('km', 'Kamil Malinowski', 'kmalinowski@gmail.com', 'nielubietygryska');
 $user1->show();
 $user2 = new User('jk', 'Jan Kowalski', 'jan.kowalski@gmail.com', '1234');
 $user2->show();
 $user2->set_user_name('nn');
 $user2->get_user_name();
 $user2->show();
 ?>
