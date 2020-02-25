Feature: Prueba de Selenium

  @javascript
  Scenario: ir a la home
    Given I go to homepage
    Then I should see "Hola mundo"