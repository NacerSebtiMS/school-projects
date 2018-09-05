repas(H,P,D) :- ho(H), p(P), d(D).

repasLeger(H,P,D) :- ho_f(H,A), p_f(P,B), d_f(D,C), A+B+C<10.

ho_f(M,P) :- ho(M), points(M,P).
p_f(M,P) :- p(M), points(M,P).
d_f(M,P) :- d(M), points(M,P).


%Donnees
%
ho(salade).
ho(pate).


p(sole).
p(thon).
p(porc).
p(boeuf).

d(glace).
d(fruit).

points(salade,1).
points(pate,6).

points(sole,2).
points(thon,4).
points(porc,7).
points(boeuf,3).

points(glace,5).
points(fruit,1).








