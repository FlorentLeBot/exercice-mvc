Feature: Authentification
In order to sign in an account
As a user
Test fonctionnel sur l'authentification d'un user

Scenario: test authentification I fill my username and password only
Given I am on the authentification page
And I authenticated as "fhollande" using "monpwd"
When I submit the form
Then I should see Accueil