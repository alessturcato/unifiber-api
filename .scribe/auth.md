# Autenticazione

Per essere autenticati nelle chiamate, è necessario includereun header **`Authorization`** nella forma **`"Basic {credentials}"`**. Il valore di `{credentials}` deve essere nomeUtente e password, uniti da due punti (:), e codificati in base64. **`Ex Basic base64(utente:password)`**

Tutti gli endpoint autenticati sono contrassegnati con un badge `richiede autenticazione` nella documentazione di seguito.
