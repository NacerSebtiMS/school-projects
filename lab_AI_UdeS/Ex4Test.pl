actionsPossibles(L,R) :-
    scrib([on(a,table),block(a),clear(a)]),
    clean(),scrib(L),
    findall(move(X,Y,Z),move(X,Y,Z),MoveIt),
    findall(moveToTable(A,B),moveToTable(A,B),MoveTT),
    append(MoveIt,MoveTT,R),
    clean().

etatSuccesseur(L,move(X,F,T),R) :-
    delete_in_set(on(X,F),L,L1),
    delete_in_set(clear(T),L1,L2),

    add_in_set(on(X,T),L2,L3),
    add_in_set(clear(F),L3,R).

etatSuccesseur(L,moveToTable(X,F),R) :-
    delete_in_set(on(X,F),L,L1),
    append([on(X,table)],L1,L2),
    append([clear(F)],L2,R).

scrib([]).
scrib([X|Z]) :- assertz(X),scrib(Z).

clean() :-

    findall(on(O,N),on(O,N),Ons),
    findall(clear(C),clear(C),Clears),
    findall(block(B),block(B),Blocks),
    cc(Ons),cc(Clears),cc(Blocks).

cc([]).
cc([X|Z]) :- retract(X),cc(Z).


move(X,F,T) :-
    block(X),block(T),
    clear(X), clear(T),
    on(X,F),not(X=F),not(X=T),not(F=T).

moveToTable(X,F) :-
    block(X),
    clear(X),
    on(X,F),not(X=F),not(F=table).

delete_in_set(_, [], []) :- !.
delete_in_set(E, [E|T], T) :- !.
delete_in_set(E, [H|T], [H|Tnew]) :- delete_in_set(E,T,Tnew).

add_in_set(E, S, S) :- member(E,S), !.
add_in_set(E, S, [E|S]).
