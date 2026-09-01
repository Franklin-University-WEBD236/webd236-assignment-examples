Unsubscribe Form [15 points]

Modify the provided Create Account example into an unsubscribe workflow. Keep the supplied routing framework and implement the form, validation, retained values, and confirmation behavior described below.

Form contract

- Include an email input, a required reason represented by grouped radio buttons, and mailing-list choices represented by grouped checkboxes.
- Keep all fields in one associative request group. The starter project uses data[...] and the tests also accept form[...] when it is used consistently.
- Associate visible labels with their inputs using matching for and id attributes.

Validation and confirmation

- Email, reason, and at least one mailing list are required.
- When validation fails, display understandable messages for every missing category and retain all values the user already submitted.
- When validation succeeds, display a confirmation containing the submitted email address and every selected mailing list.

What the automated tests check

- Form structure (2.5 points): grouped associative names, email, radio buttons, checkboxes, and associated labels.
- Required-field validation (2.5 points): an empty submission reports email, reason, and mailing-list errors.
- Retained selections (2.5 points): selected reason and mailing lists remain checked after a validation error.
- Retained email (2.5 points): the email value remains in the form after other fields fail validation.
- Confirmation (2.5 points): a valid submission displays an unsubscribe confirmation and the submitted email.
- Selected lists displayed (2.5 points): the confirmation displays every selected mailing list.

The tests inspect semantic form attributes and rendered values. Styling and whitespace do not affect the grade.
