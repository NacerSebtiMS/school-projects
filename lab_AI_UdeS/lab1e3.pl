/*
1- ajouter à la fin,
2- retirer la 1re occurrence,
3- retirer toutesles occurrences
4- dupliquer la ne valeur.
*/


gerer_liste([],L,L).
gerer_liste([1,Y|Z],L,H) :- add(L,[Y],R), gerer_liste(Z,R,H).

gerer_liste([2,Y|Z],L,H) :- remove(L,Y,R), gerer_liste(Z,R,H).

gerer_liste([3,Y|Z],L,H) :- removeAll(L,Y,R), gerer_liste(Z,R,H).

gerer_liste([4,Y|Z],L,H) :- dup(L,Y,R), gerer_liste(Z,R,H).

remove([],_,[]).
remove([E|Z],E,Z).
remove([X|Z],E,L) :- not(X=E),remove(Z,E,N), add([X],N,L).

removeAll([],_,[]).
removeAll([E|Z],E,N) :- removeAll(Z,E,N).
removeAll([X|Z],E,L) :- not(X=E),removeAll(Z,E,N), add([X],N,L).

dup([],_,[]).
dup([X|Z],1,[X,X|Z]).
dup([X|Z],N,R) :- N>1,M is N-1, dup(Z,M,L), add([X],L,R).

add([],Y,Y).
add([X|Xs],Y,[X|Zs]) :- add(Xs,Y,Zs).
