# Changelog

All notable changes to this project will be documented in this file.

## [1.1.0] - 2026-01-31

### Changed
- Redesigned email log view page with modern UI styling
- Updated view template to match AsynchronousEmailSending module design
- Moved action buttons (Back, Delete) from template to Block class using `buttonList->add()`
- Added confirmation dialog for delete action
- Improved email details display with grid layout and styled info cards
- Added status badges with color coding (success/error/pending)
- Fixed bug where Bcc field was incorrectly displaying Cc value

### Improved
- Better null handling for email log retrieval
- Consistent color scheme using brand colors (#eb5202, #666666, #4a3f39, #e3e3e3, #79a22e, #007dbd, #f5f5f5, #ffffff, #fff1ad)

## [1.0.0]

### Added
- Initial release with email logging functionality
