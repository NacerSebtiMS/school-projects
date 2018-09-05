:- [set].
/*
 *  L=[on(b, table), on(a, table), on(c, a),clear(b),clear(c),block(a), block(b), block(c)]
 actionsPossibles([on(b, table), on(a, table), on(c,a),clear(b), clear(c), block(a), block(b), block(c)], R).
 */
actionsPossibles(L,R) :-
    /*
    findall(on(Y),member(on(Y),L),Ons),
    findall(Z,member(clear(Z),L),Clears),
    */
    findall(X,member(block(X),L),Blocks),
    run(Blocks,Blocks,L,R).

run([],_,_,[]).
run(_,_,[],[]).

run([X|Z],B,L,R) :-
    not(member(on(X,table),L)),
    run_moveTT(X,L,R1),
    run(Z,B,L,R2),
    append(R1,R2,R).

run([X|Z],B,L,R) :-
    not(member(on(X,table),L)),
    delete_in_set(X,B,Bb),
    run_move(X,Bb,L,R1),
    run(Z,B,L,R2),
    append(R1,R2,R).


run([X|Z],B,L,R) :-
    delete_in_set(X,B,Bb),
    run_move(X,Bb,L,R1),
    run(Z,B,L,R2),
    append(R1,R2,R).

run_move(_,[],_,[]).
run_move(X,[A|B],L,R) :-
    run_move(X,B,L,R1),
    not(X=A),
    member(on(X,Y),L),
    not(Y=A),
    not(X=Y),
    member(clear(X),L),
    member(clear(A),L),
    append(R1,[move(X,Y,A)],R).

run_move(_,_,_,[]).


run_moveTT(_,_,[]).
run_moveTT(X,L,R) :-
    member(on(X,Y),L),
    not(X=Y),
    member(clear(X),L),
    R=[moveToTable(X,Y)].

run_moveTT(_,_,[]).



% ACTIONS
%
/*
move(X,F,T) :-
    not(X=F),not(X=T),not(F=T),
    block(X),block(T),
    clear(X), clear(T),
    on(X,F).

moveToTable(X,F) :-
    not(X=F),
    block(X),
    clear(X),
    on(X,F).
*/
l([on(b, table), on(a, table), on(c, a),clear(b),clear(c),block(a), block(b), block(c)]).
