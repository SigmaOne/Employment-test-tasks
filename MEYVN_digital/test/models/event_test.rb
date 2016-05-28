require 'test_helper'

class EventTest < ActiveSupport::TestCase
  def setup
    @event = events(:HNY)
    assert @event.valid?
  end

  test 'name, start_date, city should not be preset' do
    @event.name = ''
    assert_not @event.valid?
    @event.name = 'HNY'
    assert @event.valid?

    @event.city = nil
    assert_not @event.valid?
    @event.city = cities(:krasnodar)
    assert @event.valid?

    @event.start_date = nil
    assert_not @event.valid?
    @event.start_date = Date.new
    assert @event.valid?

    assert @event.valid?
  end

  test 'if end_date present, should not be after start_date' do
    @event.end_date = @event.start_date - 1.day
    assert_not @event.valid?

    @event.end_date = nil
    assert @event.valid?
  end
end
