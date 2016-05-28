require 'test_helper'

class FilterTest < ActiveSupport::TestCase
  def setup
    @filter = filters(:kittens_filter)
  end

  test 'name should be present' do
    @filter.name = nil
    assert_not @filter.valid?
  end

  test 'Flter allow nils but not all' do
    @filter.city = nil
    assert @filter.valid?

    @filter.start_date = nil
    assert @filter.valid?

    @filter.end_date = nil
    assert @filter.valid?

    @filter.end_date = Date.new
    @filter.event_name = nil
    assert @filter.valid?

    @filter.end_date = nil
    assert_not @filter.valid?
  end

  test 'if dates present, end_date should not be after start_date' do
    @filter.end_date = @filter.start_date - 1.day
    assert_not @filter.valid?

    @filter.end_date = nil
    assert @filter.valid?

    @filter.start_date = nil
    assert @filter.valid?
  end
end
